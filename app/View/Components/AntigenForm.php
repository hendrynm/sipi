<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AntigenForm extends Component
{

    public $antigenForm, $antigens;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($antigenForm, $antigens)
    {
        $this->antigenForm = $antigenForm;
        $this->antigens = $antigens;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.antigen-form');
    }
}
