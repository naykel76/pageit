<?php

namespace Naykel\Pageit\Components;

use Illuminate\View\Component;

class Toolbar extends Component
{

    public $formName;       // name/id of form to be submitted
    public bool $preview;   // hide show preview button
    public $routeName;      // name of the current resource

    /**
     * Create a new component instance.
     */
    public function __construct($formName, $preview = true, $routeName = null)
    {
        $this->formName = $formName;
        $this->preview = $preview;
        $this->routeName = $routeName;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('pageit::components.toolbar');
    }
}
