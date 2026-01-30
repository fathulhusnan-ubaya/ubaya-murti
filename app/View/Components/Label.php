<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $for = '',
        private bool $required = false,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.label', [
            'for' => $this->for,
            'required' => $this->required,
        ]);
    }
}
