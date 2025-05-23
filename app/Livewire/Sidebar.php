<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Sidebar extends Component
{
    public $name;
    public $canViewAdmin = false;

    public function mount()
    {
        $this->name = auth()->user()->name ?? 'Usuario';
    }

    public function render()
    {
        $this->canViewAdmin = auth()->user()->permissions()->pluck('name')->contains('ADMIN_PERMISSIONS');
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
