<?php

namespace Naykel\Pageit\Http\Livewire;

use Naykel\Gotime\Traits\WithDataTable;
use Naykel\Pageit\Models\Page;
use Livewire\WithPagination;
use Livewire\Component;


class PageTable extends Component
{
    use WithPagination, WithDataTable;

    public string $sortField = 'route_prefix';
    public string $searchField = 'title';
    public array $searchOptions = ['title' => 'Title',  'route_prefix' => 'Route', 'slug' => 'Slug',];

    public string $routePrefix = 'admin.pages';
    public string $pageTitle = 'Site Pages';
    private static $model = Page::class;

    public string $filterBy = '';

    public function render()
    {
        sleep(1);

        $query = self::$model::search($this->searchField, $this->search)
            ->when($this->filterBy == 'categories', fn ($query) => $query->where('is_category', true))
            ->when($this->filterBy == 'published', fn ($query) => $query->whereNotNull('published_at'))
            ->when($this->filterBy == 'draft', fn ($query) => $query->whereNull('published_at'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('pageit::page-table')
            ->with(['items' => $query])
            ->layout(\Naykel\Gotime\View\Layouts\AppLayout::class, [
                'pageTitle' => $this->pageTitle,
                'layout' => 'admin'
            ]);
    }
}
