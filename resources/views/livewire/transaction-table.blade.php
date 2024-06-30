<div>
    <x-gtl-search-input placeholder="Search by description..." class="maxw-sm" />

    <div class="my flex space-between">
        <div>
            <x-gt-button wire:click="$set('filterBy', '')" text="Reset" class="dark" />
            @foreach ($categories as $category)
                <x-gt-button wire:click="$set('filterBy', '{{ $category }}')"
                    text="{{ $category }}" class="dark" />
            @endforeach
        </div>
        <div>
            <x-gt-button text="Ask Question" class="pink" />
        </div>
    </div>

    <div class="grid cols-2">
        {{-- <div>
            <h2>Vanilla Chart JS</h2>
            <x-chart-js :data="$dataset" />
        </div> --}}
        <div>
            <x-chart-alpine :data="$dataset" />
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <x-gt-table.th wire:click="sortBy('created_at')" sortable
                    :direction="$this->getSortDirection('created_at')"> Date </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('description')" sortable class="w-full"
                    :direction="$this->getSortDirection('description')"> Description </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('category')" sortable class="w-full"
                    :direction="$this->getSortDirection('category')"> Category </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('amount')" sortable class="tar"
                    :direction="$this->getSortDirection('amount')"> Amount </x-gt-table.th>
            </tr>
        </thead>
        <tbody wire:loading.class="opacity-05" class="divide-y">
            @forelse($items as $transaction)
                <tr>
                    <td class="whitespace-nowrap pr-3">{{ $transaction->dateForHumans() }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->category }}</td>
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
