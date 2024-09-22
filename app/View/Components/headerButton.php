<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class headerButton extends Component
{

    public $routeName;
    public $buttonName;

    public function __construct($routeName, $buttonName)
    {
        $this->routeName = $routeName;
        $this->buttonName = $buttonName;
    }

    public function render(): View|Closure|string
    {
        return view('components.headerButton');
    }
}
