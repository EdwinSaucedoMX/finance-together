<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Sidebar extends Component
{
    public $name;

    public function mount()
    {
        $this->name = auth()->user()->name ?? 'Usuario';
    }

    public function render()
    {
        return view('livewire.sidebar');
    }

    public function logout(Logout $logout)
    {
        $logout();
    }

    #[Computed]
    public function userGroupsCount()
    {
        return auth()->user()?->groups?->count() ?? 0;
    }
}
