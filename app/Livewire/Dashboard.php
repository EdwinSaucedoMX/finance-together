<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $name;

    public function mount()
    {
        $this->name = auth()->user()->name;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
