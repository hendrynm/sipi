<?php

namespace App\View\Components\kabupaten;

use Illuminate\View\Component;

class PuskesmasFormAjax extends Component
{
    public $defaultPuskesmas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($defaultPuskesmas = null)
    {
        $this->defaultPuskesmas = $defaultPuskesmas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.kabupaten.puskesmas-form-ajax');
    }
}
