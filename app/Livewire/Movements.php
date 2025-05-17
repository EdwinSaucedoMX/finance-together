<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Movement;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Movements extends Component
{
    public $categories = [];
    public $concept = '';
    public $date = '';
    public $category = '';

    public $amount = 0;
    public $type = '';
    public $id = null;

    public function mount()
    {
        $this->categories = Category::all();
        $this->date = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.movements');
    }
    public function setMovement($id)
    {
        $this->openMovementModal();
        $movement = collect($this->movements)->firstWhere('id', $id);
        if ($movement) {
            $this->id = $movement['id'];
            $this->concept = $movement['concept'];
            $this->date = date('Y-m-d', strtotime($movement['date']));
            $this->amount = abs($movement['amount']);
            $this->type = $movement['type'];
            $this->category = $movement['category_id'];
        }
    }

    public function saveMovement()
    {
        $this->reset();
        $this->validateMovement();
        if ($this->id) {
            $this->updateMovement($this->id);
        } else {
            $this->createMovement();
        }
        $this->closeMovementModal();
    }

    public function validateMovement()
    {
        $this->validate([
            'concept' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:IN,OUT',
        ]);
    }
    public function createMovement()
    {
        Movement::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category,
            'amount' => $this->amount,
            'concept' => $this->concept,
            'type' => $this->type,
            'date' => $this->date,
        ]);
    }

    public function updateMovement($id)
    {
        $movement = Movement::find($id);
        if ($movement) {
            $movement->update([
                'amount' => $this->amount,
                'concept' => $this->concept,
                'type' => $this->type,
                'date' => $this->date,
                'category_id' => $this->category,
            ]);
        }
    }

    public function openMovementModal()
    {
        $this->modal('movement')->show();
    }
    public function closeMovementModal()
    {
        $this->reset(['concept', 'date', 'amount', 'type', 'id']);
        $this->modal('movement')->close();
    }

    public function deleteMovement($id)
    {
        $movement = Movement::find($id);
        if ($movement) {
            $movement->delete();
        }
    }

    #[Computed]
    public function movements()
    {
        return Movement::where('user_id', auth()->id())
            ->leftJoin('categories', 'movements.category_id', '=', 'categories.id')
            ->select('movements.*', 'categories.name as category_name')
            ->get();

    }
    #[Computed]
    public function total()
    {
        return Movement::where('user_id', auth()->id())
            ->where('type', 'IN')
            ->sum('amount') - Movement::where('user_id', auth()->id())
                ->where('type', 'OUT')
                ->sum('amount');
    }
}
