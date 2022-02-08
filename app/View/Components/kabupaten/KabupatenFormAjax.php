<?php

namespace App\View\Components\kabupaten;

use Illuminate\View\Component;

class KabupatenFormAjax extends Component
{
    public $defaultKabupaten;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.kabupaten.kabupaten-form-ajax');
    }
}
