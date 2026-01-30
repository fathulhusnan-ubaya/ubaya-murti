<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $action = '',
        private string $method = 'GET',
        private string $submit = '',
        private string $submitIconType = 'fa-solid',
        private string $submitIcon = 'fa-paper-plane',
        private bool $submitBlock = false,
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
        return view('components.form', [
            'action' => $this->action,
            'method' => $this->method,
            'submit' => $this->submit,
            'submitIconType' => $this->submitIconType,
            'submitIcon' => $this->submitIcon,
            'submitBlock' => $this->submitBlock,
        ]);
    }
}
