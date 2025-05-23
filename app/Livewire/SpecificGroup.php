<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Group;
use App\Models\Movement;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Mail\GroupInvite;
use Illuminate\Support\Facades\Mail;
class SpecificGroup extends Component
{
    public $id;
    public $name;
    public $created_at;
    public $email;


    public $concept = '';
    public $date = '';
    public $category = '';
    public $amount = 0;
    public $type = '';

    public function render()
    {
        return view('livewire.specific-group');
    }
    public function mount($id)
    {
        $this->id = $id;

        if ($this->group) {
            $this->name = $this->group->name;
            $this->created_at = $this->group->created_at;
        }

    }

    public function saveMovement()
    {

        $this->validate([
            'concept' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string|in:IN,OUT',
            'category' => 'required|exists:categories,id',
        ]);

        $movement = Movement::create([
            'concept' => $this->concept,
            'date' => $this->date,
            'amount' => $this->amount,
            'type' => $this->type,
            'category_id' => $this->category,
            'group_id' => $this->id,
            'user_id' => auth()->user()->id,
        ]);


        $this->reset([
            'concept',
            'date',
            'amount',
            'type',
            'category',
        ]);
    }



    #[Computed]
    public function group()
    {
        return Group::find($this->id);
    }



    #[Computed]
    public function users()
    {
        return $this->group->users;
    }

    #[Computed]
    public function groupMovements()
    {
        return $this->group->movements()->with(['category', 'user'])->get()->map(function ($movement) {
            $movement->category_name = $movement->category ? $movement->category->name : null;
            $movement->user_name = $movement->user ? $movement->user->name : null;
            return $movement;
        });
    }


    #[Computed]
    public function total()
    {
        $in = Movement::where('group_id', $this->id)
            ->where('type', 'IN')
            ->sum('amount');

        $out = Movement::where('user_id', $this->id)
            ->where('type', 'OUT')
            ->sum('amount');

        return $in - $out;
    }

    #[Computed]
    public function movementId()
    {
        $queryParameters = request()->query();
        $movementId = $queryParameters['movement_id'] ?? null;
        return $movementId;
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }


    public function openMovementModal()
    {
        $this->reset(['concept', 'date', 'amount', 'type', 'id', 'category']);
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

    public function openUpdateAction()
    {
        // Get the movement Id from the query string
        $queryParameters = request()->query();
        $movementId = $queryParameters['movement_id'] ?? null;
        // Check if the movementId is the same as the one passed to the function
    }

    public function invite()
    {
        $this->validate([
            'email' => 'required|email',
        ]);
        $groupId = $this->id;
        Mail::to($this->email)->send(new GroupInvite($this->email, $groupId));

        $this->modal('invite')->close();
    }
}
