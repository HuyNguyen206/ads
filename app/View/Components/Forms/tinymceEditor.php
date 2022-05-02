<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class tinymceEditor extends Component
{
    public $name;
    public $oldValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $oldValue = null)
    {
        //
        $this->name = $name;
        $this->oldValue = $oldValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.tinymce-editor');
    }
}
