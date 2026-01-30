<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $label = '',
        private string $id = '',
        private string $name = '',
        private string $prepand = '',
        private string $append = '',
        private string $type = 'text',
        private string $placeholder = '',
        private string $value = '',
        private string $accept = '',
        private string $min = '',
        private string $max = '',
        private string $classInput = '',
        private bool $required = false,
        private bool $disabled = false,
        private bool $readonly = false,
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
        return view('components.input', [
            'label' => $this->label,
            'id' => $this->id,
            'name' => $this->name,
            'prepand' => $this->prepand,
            'append' => $this->append,
            'type' => $this->type,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'accept' => $this->accept,
            'min' => $this->min,
            'max' => $this->max,
            'classInput' => $this->classInput,
            'required' => $this->required,
            'disabled' => $this->disabled,
            'readonly' => $this->readonly,
        ]);
    }
}
