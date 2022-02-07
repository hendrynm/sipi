<?php

namespace App\View\Components;

use Illuminate\View\Component;

class KabupatenFormAjaxDefault extends Component
{
    public $kabupatenDefault;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($kabupatenDefault)
    {
        $this->kabupatenDefault = $kabupatenDefault;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.kabupaten-form-ajax-default');
    }
}
