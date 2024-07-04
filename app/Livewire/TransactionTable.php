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
    public string $filterBy = '';

    /**
     * Holds the chart data as a public property
     */
    public array $dataset = [];

    public array $categories = [];

    public function mount()
    {
        $this->sortColumn = 'created_at';
        $this->sortDirection = 'desc';

        $this->categories = $this->modelClass::select('category')
            ->distinct()->pluck('category')->toArray();
    }

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);
        $query = $this->applySearch($query);
        $query = $this->applyFilter($query);

        // this will run the query twice, once for the table and once for the chart
        $this->dataset = $this->setChartData($query->get());

        return ['items' => $query->paginate(48)];
    }

    public function setChartData($data)
    {
        $totalsByCategory = $data->groupBy('description')
            ->map(fn ($items) => $items->sum('amount'));


        $compare = $totalsByCategory->map(fn ($value) => $value * (rand(60, 140) / 100.0));

        return [
            'labels' => $totalsByCategory->keys()->all(),
            'values' => $totalsByCategory->values()->all(),
            'compare' => $compare->values()->all(),
        ];
    }

    public function applyFilter($query)
    {
        if (empty($this->filterBy)) return $query;

        return $this->modelClass::query()
            ->when(
                $this->filterBy === $this->filterBy,
                fn ($query) => $query->whereCategory($this->filterBy)
            );
    }

    public function render()
    {
        return view($this->view, $this->prepareData())
            ->layout('components.layouts.app', [
                'pageTitle' => $this->pageTitle,
            ]);
    }
}
