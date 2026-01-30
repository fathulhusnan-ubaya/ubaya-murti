<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $id,
        private string $size = 'md',
        private string $header = '',
        private string $footer = '',
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
        return view('components.modal', [
            'id' => $this->id,
            'size' => $this->size,
            'header' => $this->header,
            'footer' => $this->footer,
        ]);
    }
}
