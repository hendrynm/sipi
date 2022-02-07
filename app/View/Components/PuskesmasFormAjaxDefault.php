<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PuskesmasFormAjaxDefault extends Component
{
    public $puskesmasDefault;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($puskesmasDefault)
    {
        $this->puskesmasDefault = $puskesmasDefault;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.puskesmas-form-ajax-default');
    }
}
