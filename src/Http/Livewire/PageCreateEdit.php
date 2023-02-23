<?php

namespace Naykel\Pageit\Http\Livewire;

use Naykel\Gotime\Traits\WithCrud;
use Naykel\Pageit\Models\Page;
use Livewire\Component;

class PageCreateEdit extends Component
{
    use WithCrud;

    private static $model = Page::class;
    public string $routePrefix = 'admin.pages';
    public string $title;
    public array $initialData = [];

    public object $editing;

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.layout' => 'required|in:' . collect(self::$model::LAYOUTS)->keys()->implode(','),
            // 'editing.*' => 'sometimes', // ???
            'editing.route_prefix' => 'sometimes',
            'editing.slug' => 'sometimes',
            'editing.headline' => 'sometimes',
            'editing.hide_title' => 'sometimes',
            'editing.is_category' => 'sometimes',
            'editing.type' => 'sometimes',
            'editing.body' => 'sometimes', // review for conditional use
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

    public function render()
    {
        return view('pageit::page-create-edit')
            ->layout(\Naykel\Gotime\View\Layouts\AppLayout::class, [
                'title' => $this->title,
                'layout' => 'admin'
            ]);
    }
}
