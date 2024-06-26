<div>
    <x-gtl-search-input placeholder="Search by description..." class="maxw-sm" />
    <table>
        <thead>
            <tr>
                <x-gt-table.th wire:click="sortBy('created_at')" sortable
                    :direction="$this->getSortDirection('created_at')"> Date </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('description')" sortable class="w-full"
                    :direction="$this->getSortDirection('description')"> Description </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('amount')" sortable class="tar"
                    :direction="$this->getSortDirection('amount')"> Amount </x-gt-table.th>
            </tr>
        </thead>
        <tbody wire:loading.class="opacity-05" class="divide-y">
            @forelse($items as $transaction)
                <tr>
                    <td class="whitespace-nowrap pr-3">{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="tar">${{ $transaction->amount }}</td>
                </tr>
            @empty
                <tr>
                    <td class="tac pxy txt-lg" colspan="6">No records found...</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $items->links('gotime::pagination.livewire') }}
</div>
