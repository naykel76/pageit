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
    public string $title;
    public array $initialData = [];

    public object $editing;

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.layout' => 'required|in:' . collect(self::$model::LAYOUTS)->keys()->implode(','),
            // if is_category = true, see if any other pages have
            // is_category=true AND route_prefix the same as the current
            'editing.route_prefix' => [
                Rule::requiredIf($this->editing->is_category),
                Rule::unique('pages', 'route_prefix')
                    ->where(function ($query) {
                        if ($this->editing->is_category) {
                            return $query->where('route_prefix', $this->editing->route_prefix);
                        }
                        // must have always false condition, else returns true
                        return $query->whereRaw('1=0');
                    })
                    ->ignore($this->editing->id)
            ],
            'editing.slug' => 'sometimes',
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

    protected $messages = [
        'editing.route_prefix.unique' => 'You must set a unique route prefix for a category landing page. This error indicates that you already have a category landing page with this route_prefix.',
    ];

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
        $this->tmpUpload ? $this->handleUpload($this->tmpUpload, disk: 'content', withOriginalName: true) : null;
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
