<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    {{-- Table for users, name, email createdAt and actions columns --}}

    <h1 class="text-xl font-semibold uppercase py-4">Users to Verify</h1>
    {{-- Table with name, email, createdAt and actions --}}
    @if ($canVerify)
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('Name') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('Email') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('Created At') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                {{-- Loop through users and display their information --}}
                @foreach ($this->users->whereNull('email_verified_at') as $user)
                    <tr class="{{ auth()->id() === $user->id ? 'bg-blue-100 dark:bg-blue-900' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $user->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="verify({{ $user->id }})" type="button"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                Verify Email
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h1 class="text-xl font-semibold uppercase py-4">Permissions</h1>

    @if ($canAssignPermissions)
        <div class="my-6">
            <flux:modal.trigger name="permission-modal">
                <flux:button color="primary">
                    Assign Permissions to user
                </flux:button>
            </flux:modal.trigger>
        </div>

    @endif

    {{-- Table with name and description --}}
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Name') }}
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Description') }}
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
            @foreach ($this->permissions as $permission)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                        {{ $permission->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $permission->description }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{-- Modal using Flux --}}
    <flux:modal name="permission-modal" max-width="2xl">
        <x-slot name="title">
            Assign Permissions to User
        </x-slot>

        <div class="mb-4">
            <flux:label for="user" value="Select User" />
            <flux:select wire:change="selectUser($event.target.value)" id="user" class="w-full">
                <option value="">-- Select User --</option>
                @foreach($this->users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </flux:select>
        </div>


        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mb-4">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('Permission') }}
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ __('Assigned') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                @if($this->userPermissions)
                    @foreach($this->permissions as $permission)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $permission->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 *:border">
                                <flux:checkbox wire:change="togglePermission({{ $userId }}, {{ $permission->id }})"
                                    :checked="$this->userPermissions->contains('id', $permission->id)" />
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            No permissions available.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <x-slot name="footer">
            <flux:button color="secondary" wire:click="closePermissionModal">
                Close
            </flux:button>
        </x-slot>
    </flux:modal>
</div>