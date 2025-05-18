<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Groups extends Component
{
    public $name;
    public $id = null;

    public function render()
    {
        return view('livewire.groups');
    }

    #[Computed]
    public function groups()
    {
        return auth()->user()->groups;
    }

    public function openGroupModal()
    {
        $this->reset([
            'name',
            'id',
        ]);
        $this->modal('group')->show();
    }

    public function createGroup()
    {
        $group = Group::create([
            'name' => $this->name,
        ]);

        auth()->user()->groups()->attach($group->id);

    }

    public function updateGroup($groupId)
    {
        $group = Group::find($groupId);

        if ($group) {
            $group->update([
                'name' => $this->name,
            ]);
        }
    }

    public function saveGroup()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($this->id) {
            $this->updateGroup($this->id);
        } else {
            $this->createGroup();
        }


        $this->reset([
            'name',
            'id',
        ]);
        $this->modal('group')->close();
    }

    public function deleteGroup($groupId)
    {
        $group = Group::find($groupId);

        if ($group) {
            auth()->user()->groups()->detach($groupId);
            $group->delete();
        }
    }

    public function editGroup($groupId)
    {
        $group = Group::find($groupId);

        if ($group) {
            $this->openGroupModal();
            $this->id = $group->id;
            $this->name = $group->name;
        }
    }

    public function viewGroup($groupId)
    {
        // Redirect to the group view page
        return redirect()->route('specific-group', ['id' => $groupId]);
    }
}
