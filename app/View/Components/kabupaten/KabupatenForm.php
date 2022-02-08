<?php

namespace App\View\Components\kabupaten;

use Illuminate\View\Component;

class KabupatenForm extends Component
{
    public $kabupatens;
    public $kabupatenForm;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($kabupatens, $kabupatenForm)
    {
        $this->kabupatens = $kabupatens;
        $this->kabupatenForm = $kabupatenForm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.kabupaten.kabupaten-form');
    }
}
