<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h1 class="text-3xl font-bold text-accent mb-2">{{$name}}</h1>
    <p class="text-sm text-gray-500 mb-4">
        Created on: {{ date('F j, Y \a\t g:i A', strtotime($created_at)) }}
    </p>

    <h2 class="text-xl font-semibold text-accent-content dark:text-zinc-200 mb-4">
        Group Members
    </h2>
    <p class="text-sm text-gray-500 mb-4">
        Here are the users who are part of this group.
    </p>
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
                    Email
                </th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Joined At
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-900 dark:divide-zinc-700">
            @foreach($this->users as $user)
                <tr>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ $user->name }}</td>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ $user->email }}</td>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ date('F j, Y', strtotime($user->pivot->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-xl font-semibold text-accent-content dark:text-zinc-200 mt-8 mb-4">
        Movements
    </h2>
    <p class="text-sm text-gray-500 mb-4">
        Here are the movements associated with this group.
    </p>
    <flux:modal.trigger name="movement" class="mb-4">
        {{--
        wire:click="$emit('openModal', 'movement', {{ json_encode(['group_id' => $this->groupId]) }})"> --}}
        <flux:button variant="primary" icon="plus" size="sm">
            Add Movement
        </flux:button>
    </flux:modal.trigger>
    <flux:modal.trigger name="invite" class="mb-4">
        <flux:button class="mb-4" variant="outline" icon="user" size="sm">
            Invite to Group
        </flux:button>
    </flux:modal.trigger>
    <table
        class="mt-4 min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden shadow bg-white dark:bg-zinc-900 dark:divide-zinc-700">
        <thead class="bg-gray-100 dark:bg-zinc-950">
            <tr>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Date</th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Amount
                </th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Concept</th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Category
                </th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    Type
                </th>
                <th
                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-zinc-300">
                    User
                </th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider
                    dark:text-zinc-300">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-zinc-900 dark:divide-zinc-700">
            @foreach($this->groupMovements as $movement)
                <tr>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ $movement['date'] }}</td>
                    <td
                        class="px-4 py-2 {{ $movement['type'] === 'IN' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} font-semibold">
                        ${{$movement['type'] === 'OUT' ? '-' : ''}}{{ number_format($movement['amount'], 2) }}
                    </td>
                    <td class="px-4 py-2 dark:text-zinc-200">{{ $movement['concept'] }}</td>
                    <td class="px-4 py-2 dark:text-zinc-200">
                        {{ $movement['category_name'] }}
                    </td>
                    <td class="px-4 py-2">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold rounded
                                                                                                                                                                    {{ $movement['type'] === 'IN' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                            {{ $movement['type'] === 'IN' ? 'Income' : 'Expense' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 dark:text-zinc-200">
                        {{ $movement['user_name'] }}
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <flux:tooltip content="Edit movement" wire:click="setMovement('{{ $movement['id'] }}')">
                            <flux:button class="*:text-blue-500 dark:*:text-blue-400" size="sm" variant="ghost"
                                icon="pencil" title="Edit" />
                        </flux:tooltip>
                        <flux:tooltip content="Delete movement">
                            <flux:button class="*:text-red-500 dark:*:text-red-400" size="sm" variant="ghost" icon="trash"
                                color="danger" title="Delete" wire:confirm="Are you sure you want to delete this movement?"
                                wire:click="deleteMovement('{{$movement['id']}}')" />
                        </flux:tooltip>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-gray-50 dark:bg-zinc-800">
            <tr
                class="{{ $this->total >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                <td colspan="2" class="px-4 py-2 font-bold text-right">Total</td>
                <td class="px-4 py-2 font-bold">
                    ${{ number_format($this->total, 2) }}
                </td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
    </table>
    <flux:modal name="movement" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $this->movementId ? 'Edit Movement' : 'Add Movement' }}</flux:heading>
                <flux:text class="mt-2">
                    {{ $this->movementId ? 'Edit the movement.' : 'Create a new movement.' }}
                </flux:text>
            </div>
            <flux:input label="Date" type="date" wire:model="date" />
            <flux:error name="date" />
            <flux:input label="Amount" type="number" step="0.01" wire:model="amount" />
            <flux:error name="amount" />
            <flux:input label="Concept" wire:model="concept" />
            <flux:error name="concept" />
            <flux:select label="Type" wire:model="type">
                <option value="" disabled>Select type</option>
                <option value="IN">Income</option>
                <option value="OUT">Expense</option>
            </flux:select>
            <flux:select label="Category" wire:model="category">
                <option value="" disabled>Select category</option>
                @foreach($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="category_id" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="button" wire:click="saveMovement" variant="primary">
                    {{ $this->movementId ? 'Update' : 'Add' }}
                </flux:button>
            </div>
        </div>
    </flux:modal>


    <flux:modal name="invite" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Invite to Group</flux:heading>
                <flux:text class="mt-2">
                    Invite a user to this group.
                </flux:text>
            </div>
            <flux:input label="Email" type="email" wire:model="email" />
            <flux:error name="email" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="button" wire:click="invite" variant="primary">
                    Invite
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>