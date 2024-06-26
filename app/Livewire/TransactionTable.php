<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Searchable;
use Naykel\Gotime\Traits\Sortable;

class TransactionTable extends Component
{
    use WithPagination, Searchable, Sortable;

    private string $modelClass  = Transaction::class;
    public string $pageTitle = 'Transactions Table';
    public string $view = 'livewire.transaction-table';

    public array $searchableFields = ['code', 'title',];

    public function mount()
    {
        $this->sortColumn = 'created_at';
        $this->sortDirection = 'desc';
    }

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);
        $query = $this->applySearch($query);
        return ['items' => $query->paginate(48)];
    }

    public function render()
    {
        return view($this->view, $this->prepareData())
            ->layout('components.layouts.app', [
                'pageTitle' => $this->pageTitle,
            ]);
    }
}
