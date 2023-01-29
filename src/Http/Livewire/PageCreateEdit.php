<?php

namespace Naykel\Pageit\Http\Livewire;

use Naykel\Gotime\Traits\WithCrud;
use Naykel\Pageit\Models\Page;
use Livewire\WithPagination;
use Livewire\Component;

class PageCreateEdit extends Component
{
    use WithPagination, WithCrud;

    private static $model = Page::class;
    public string $routePrefix = 'admin.pages';
    public string $title;
    public array $initialData = [];

    public object $editing;

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.body' => 'sometimes',
            'editing.sort_order' => 'nullable|numeric',
            'tmpUpload' => 'nullable|image',
        ];
    }

    public function mount(Page $page)
    {
        $this->editing = $page ? $page : $this->makeBlankModel();
        $this->isPublished = $this->editing->isPublished();
        $this->title = $this->setTitle();
    }

    protected function beforePersistHook()
    {
        $this->handlePublishedStatus();
    }

    protected function afterPersistHook()
    {
        $this->tmpUpload ? $this->handleUpload($this->tmpUpload) : null;
    }

    public function render()
    {
        return view('pageit::page-create-edit')
            ->layout(\Naykel\Gotime\View\Layouts\AppLayout::class, ['title' => $this->title, 'layout' => 'admin']);
    }
}
