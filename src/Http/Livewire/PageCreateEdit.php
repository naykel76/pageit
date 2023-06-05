<?php

namespace Naykel\Pageit\Http\Livewire;

use Naykel\Gotime\Traits\WithCrud;
use Illuminate\Validation\Rule;
use Naykel\Pageit\Models\Page;
use Livewire\Component;

class PageCreateEdit extends Component
{
    use WithCrud;

    private static $model = Page::class;
    public string $routePrefix = 'admin.pages';
    public string $pageTitle;
    public array $initialData = ['layout' => ''];

    public object $editing;

    public function rules()
    {

        return [
            'editing.title' => 'required|min:3',
            'editing.layout' => 'required|in:' . collect(self::$model::LAYOUTS)->keys()->implode(','),
            // This route_prefix validation feels dirty but it works!
            'editing.route_prefix' => [
                Rule::requiredIf($this->editing->is_category),
                // validation will fail if the current route_prefix
                // already exists on another item that is a category
                function ($attribute, $value, $fail) {
                    // if not a category, get out
                    if (!$this->editing->is_category) return;
                    // exclude the current item if it's being edited
                    $excludeId = $this->editing->id ?? null;

                    if (in_array($value, Page::categories()->where('id', '<>', $excludeId)->pluck('route_prefix')->toArray())) {
                        $fail('The route prefix must be unique among category pages. This error indicates you already have a category page with this route_prefix');
                    }
                }
            ],

            'editing.slug' => 'sometimes',
            'editing.lead_text' => 'sometimes',
            'editing.headline' => 'sometimes',
            'editing.is_category' => 'sometimes',
            'editing.body' => 'sometimes', // review for conditional use
            'editing.sort_order' => 'nullable|numeric',
            'tmpUpload' => 'nullable|image',
            'editing.config.advanced_code' => 'sometimes',
            'editing.config.hide_title' => 'sometimes',
            'editing.config.type' => 'sometimes',
        ];
    }



    public function mount(Page $page)
    {
        $this->editing = $page->id ? $page : $this->makeBlankModel();
        $this->isPublished = $this->editing->isPublished();
        $this->pageTitle = $this->setTitle();
    }

    protected function beforePersistHook()
    {

        $this->handlePublishedStatus();
    }

    protected function afterPersistHook()
    {
        $this->tmpUpload ? $this->handleUpload($this->tmpUpload, disk: 'content', withOriginalName: true) : null;
    }

    public function render()
    {
        return view('pageit::page-create-edit')
            ->layout(\Naykel\Gotime\View\Layouts\AppLayout::class, [
                'pageTitle' => $this->pageTitle,
                'layout' => 'admin'
            ]);
    }
}
