<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tick extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $color = 'primary',
        private string $label = '',
        private string $id = '',
        private string $name = '',
        private string $classInput = '',
        private string $value = '1',
        private string $type = 'radio',
        private bool $inline = false,
        private bool $required = false,
        private bool $disabled = false,
        private bool $readonly = false,
        private bool $checked = false,
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
        return view('components.tick', [
            'color' => $this->color,
            'label' => $this->label,
            'id' => $this->id,
            'name' => $this->name,
            'classInput' => $this->classInput,
            'value' => $this->value,
            'type' => $this->type,
            'inline' => $this->inline,
            'required' => $this->required,
            'disabled' => $this->disabled,
            'readonly' => $this->readonly,
            'checked' => $this->checked,
        ]);
    }
}
