<div>
    <flux:button class="mt-4" wire:click="openGroupModal" icon="plus" color="primary">
        Create Group
    </flux:button>
    <table
        class="mt-4 min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden shadow bg-white dark:bg-zinc-900 dark:divide-zinc-700">
        <thead class="bg-gray-100 dark:bg-zinc-950">
            <tr>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Name
                </th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Created On
                </th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-900 dark:divide-zinc-700">
            @foreach($this->groups as $group)
                <tr>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ $group->name }}</td>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ $group->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <flux:tooltip content="Edit group" wire:click="editGroup('{{ $group->id }}')">
                            <flux:button class="*:text-blue-500 dark:*:text-blue-400" size="sm" variant="ghost"
                                icon="pencil" title="Edit" />
                        </flux:tooltip>
                        <flux:tooltip content="Delete group">
                            <flux:button class="*:text-red-500 dark:*:text-red-400" size="sm" variant="ghost" icon="trash"
                                color="danger" title="Delete" wire:confirm="Are you sure you want to delete this group?"
                                wire:click="deleteGroup('{{ $group->id }}')" />
                        </flux:tooltip>
                        <flux:tooltip content="View group">
                            <flux:button class="*:text-blue-500 dark:*:text-blue-400" size="sm" variant="ghost" icon="eye"
                                title="View" wire:click="viewGroup('{{ $group->id }}')" />
                        </flux:tooltip>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <flux:modal name="group" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ 'Group' }}</flux:heading>
                <flux:text class="mt-2">
                    {{ 'Create a new group.' }}
                </flux:text>
            </div>
            <flux:input label="Group name" placeholder="Enter group name" wire:model="name" />
            <flux:error name="name" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="button" wire:click="saveGroup" variant="primary">
                    'Add'
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>