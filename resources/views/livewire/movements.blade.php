<div>
    <h1>Movements</h1>
    <div class="flex flex-col">
        <flux:button class="self-end" variant="primary" icon="plus" wire:click="openMovementModal">New movement
        </flux:button>
        <table class="mt-4 min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden shadow bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Concept</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($this->movements as $movement)
                    <tr>
                        <td class="px-4 py-2">{{ $movement['date'] }}</td>
                        <td
                            class="px-4 py-2 {{ $movement['type'] === 'IN' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            ${{$movement['type'] === 'OUT' ? '-' : ''}}{{ number_format($movement['amount'], 2) }}
                        </td>
                        <td class="px-4 py-2">{{ $movement['concept'] }}</td>
                        <td class="px-4 py-2">
                            {{ $movement['category_name'] }}
                        </td>
                        <td class="px-4 py-2">
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold rounded
                                                                                                                                                                                                                                                                                                                                                {{ $movement['type'] === 'IN' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $movement['type'] === 'IN' ? 'Income' : 'Expense' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <flux:tooltip content="Edit movement" wire:click="setMovement('{{ $movement['id'] }}')">
                                <flux:button class="*:text-blue-500" size="sm" variant="ghost" icon="pencil" title="Edit" />
                            </flux:tooltip>
                            <flux:tooltip content="Delete movement">
                                <flux:button class="*:text-red-500" size="sm" variant="ghost" icon="trash" color="danger"
                                    title="Delete" wire:confirm="Are you sure you want to delete this movement?"
                                    wire:click="deleteMovement('{{$movement['id']}}')" />
                            </flux:tooltip>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                <tr class="{{ $this->total >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    <td colspan="2" class="px-4 py-2 font-bold text-right">Total</td>
                    <td class="px-4 py-2 font-bold">
                        ${{ number_format($this->total, 2) }}
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Modals --}}
    <flux:modal name="movement" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add a movement</flux:heading>
                <flux:text class="mt-2">Create a movement.</flux:text>
            </div>
            <flux:input label="Date of movement" type="date" wire:model="date" />
            <flux:field>
                <flux:label>Amount</flux:label>
                <flux:input.group>
                    <flux:input.group.prefix>$</flux:input.group.prefix>
                    <flux:input wire:model="amount" type="number" placeholder="1.00" />
                </flux:input.group>
                <flux:error name="amount" />
            </flux:field>
            <flux:textarea label="Concept" placeholder="Movement concept" wire:model="concept" />
            <flux:select wire:model="type" label="Type" wire:change="updateType($event.target.value)">
                <flux:select.option value="" disabled selected>Select a type</flux:select.option>
                <flux:select.option value="IN">Income</flux:select.option>
                <flux:select.option value="OUT">Expense</flux:select.option>
            </flux:select>
            <flux:select label="Category" wire:model="category" :disabled="!$type">
                <flux:select.option value="" disabled selected>Select a category</flux:select.option>
                @foreach($this->categories as $category)
                    <flux:select.option value="{{ $category['id'] }}">{{ $category['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <div class="flex">
                <flux:spacer />
                <flux:button type="button" wire:click="saveMovement({{$id}})" variant="primary">Add</flux:button>
            </div>
        </div>
    </flux:modal>
</div>