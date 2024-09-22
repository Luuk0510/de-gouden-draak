<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $type;
    public $id;
    public $name;
    public $placeholder;
    public $value;

    public function __construct($label = '', $type = 'text', $id = '', $name = '', $placeholder = '', $value = '')
    {
        $this->label = $label;
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;   
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
