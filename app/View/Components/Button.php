<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $type = 'button',
        private string $href = '',
        private string $color = 'primary',
        private string $iconType = 'fa-solid',
        private string $icon = '',
        private string $size = 'md',
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
        return view('components.button', [
            'type' => $this->type,
            'href' => $this->href,
            'color' => $this->color,
            'iconType' => $this->iconType,
            'icon' => $this->icon,
            'size' => $this->size,
        ]);
    }
}
