<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class Sidebar extends Component
{
    public $name;

    public function mount()
    {
        $this->name = auth()->user()->name;
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
    public function logout(Logout $logout)
    {
        $logout();
    }
}
