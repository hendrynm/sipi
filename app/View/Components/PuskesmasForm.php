<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PuskesmasForm extends Component
{
    public $puskesmasForm, $puskesmas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($puskesmasForm, $puskesmas)
    {
        $this->puskesmasForm = $puskesmasForm;
        $this->puskesmas = $puskesmas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.puskesmas-form');
    }
}
