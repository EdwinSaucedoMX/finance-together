<?php

namespace App\Livewire;

use Livewire\Component;


class Dashboard extends Component
{
    public $name;
    public $expenses = 0;
    public $incomes = 0;
    public $balance = 0;
    public $mostExpensiveCategory = null;
    public $lessExpensiveCategory = null;

    public function mount()
    {
        $this->expenses = auth()->user()->movements()->where('type', 'OUT')->sum('amount');
        $this->incomes = auth()->user()->movements()->where('type', 'IN')->sum('amount');
        $this->balance = $this->incomes - $this->expenses;
        $this->mostExpensiveCategory = auth()->user()->movements()
            ->where('movements.type', 'OUT')
            ->join('categories', 'movements.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category_name, movements.category_id, sum(movements.amount) as total')
            ->groupBy('movements.category_id', 'categories.name')
            ->orderBy('total', 'desc')
            ->first();

        $this->lessExpensiveCategory = auth()->user()->movements()
            ->where('movements.type', 'OUT')
            ->join('categories', 'movements.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category_name, movements.category_id, sum(movements.amount) as total')
            ->groupBy('movements.category_id', 'categories.name')
            ->orderBy('total', 'asc')
            ->first();

        $this->name = auth()->user()->name;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function click()
    {
        dd('click');
        return;

    }
}
