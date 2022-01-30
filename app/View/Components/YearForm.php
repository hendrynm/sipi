<?php

namespace App\View\Components;

use Illuminate\View\Component;

class YearForm extends Component
{   
    public $tahunForm;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tahunForm)
    {
        $this->tahunForm = $tahunForm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.year-form');
    }
}
