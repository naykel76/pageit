<?php

namespace Naykel\Pageit\Http\Livewire;

use Naykel\Gotime\Traits\WithCrud;
use Livewire\Component;
use Naykel\Pageit\Models\Page;

class PageBuilder extends Component
{
    use WithCrud;

    private static $model = Page::class;
    public string $routePrefix = 'page-builder';
    public array $initialData = ['type' => 'builder'];
    public object $editing;
    public string $title;

    protected $rules = [
        'editing.title' => 'required|min:3',
        'editing.body' => 'sometimes',
        'editing.type' => 'required', // set in initial data
    ];

    public function mount(Page $page)
    {
        // if there is a page id, then set editing to the existing record
        $this->editing = $page->id ? $page : $this->makeBlankModel();
        $this->title = $this->setTitle();
    }

    public function render()
    {
        return view('livewire.page-builder')
            ->layout(\Naykel\Gotime\View\Layouts\AppLayout::class, ['title' => $this->title, 'layout' => 'admin']);
    }
}
