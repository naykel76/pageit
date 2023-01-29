<?php

namespace Naykel\Pageit\Http\Livewire;

use Naykel\Gotime\Traits\WithDataTable;
use Naykel\Pageit\Models\Page;
use Livewire\WithPagination;
use Livewire\Component;

class PageTable extends Component
{
    use WithPagination, WithDataTable;

    public string $sortField = 'title';
    public string $searchField = 'title';
    public array $searchOptions = ['title' => 'Title'];

    public string $routePrefix = 'admin.pages';
    public string $title = 'Site Pages Table';
    private static $model = Page::class;

    public function render()
    {
        sleep(1);

        $query = self::$model::search($this->searchField, $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('pageit::page-table')->with(['items' => $query])
            ->layout(
                \Naykel\Gotime\View\Layouts\AppLayout::class,
                [
                    'title' => $this->title,
                    'layout' => 'admin'
                ]
            );
    }
}
