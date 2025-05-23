<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Admin extends Component
{
    public $permissionId;
    public $userId;

    public $canVerify = false;
    public $canAssignPermissions = false;
    // Enum for permission types
    const PERMISSION_TYPES = [
        'verify_users' => 'VERIFY_USERS',
        'assign_permissions' => 'ASSIGN_PERMISSIONS',
    ];
    public function mount()
    {
        $currentPermissions = auth()->user()->permissions->pluck('name')->toArray();
        $this->canVerify = in_array(self::PERMISSION_TYPES['verify_users'], $currentPermissions);
        $this->canAssignPermissions = in_array(self::PERMISSION_TYPES['assign_permissions'], $currentPermissions);
    }
    public function render()
    {
        return view('livewire.admin');
    }



    public function verify($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->markEmailAsVerified();
            session()->flash('message', 'Email verified successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    #[Computed]
    public function users()
    {
        return User::all();
    }


    #[Computed]
    public function permissions()
    {
        return Permission::all();
    }

    public function assignPermission($userId)
    {
        $user = User::find($userId);
        $permission = Permission::find($this->permissionId);

        if ($user && $permission) {
            $user->permissions()->attach($permission);
            session()->flash('message', 'Permission assigned successfully.');
        } else {
            session()->flash('error', 'User or permission not found.');
        }
    }


    public function removePermission($userId, $permissionId)
    {
        $user = User::find($userId);
        $permission = Permission::find($permissionId);

        if ($user && $permission) {
            $user->permissions()->detach($permission);
            session()->flash('message', 'Permission removed successfully.');
        } else {
            session()->flash('error', 'User or permission not found.');
        }
    }


    public function togglePermission($userId, $permissionId)
    {
        $user = User::find($userId);
        $permission = Permission::find($permissionId);

        if ($user && $permission) {
            if ($user->permissions()->where('id', $permissionId)->exists()) {
                $user->permissions()->detach($permission);
                session()->flash('message', 'Permission removed successfully.');
            } else {
                $user->permissions()->attach($permission);
                session()->flash('message', 'Permission assigned successfully.');
            }
        } else {
            session()->flash('error', 'User or permission not found.');
        }
    }


    public function selectUser($userId)
    {
        $this->userId = $userId;
    }

    #[Computed]
    public function userPermissions()
    {
        return $this->userId ? User::find($this->userId)->permissions : [];
    }
}
