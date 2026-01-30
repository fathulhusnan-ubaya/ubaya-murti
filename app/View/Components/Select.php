<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
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
        private string $placeholder = '-- Pilih --',
        private array|Collection $options = [],
        private string|array $value = '',
        private string $route = '',
        private string $classInput = '',
        private bool $multiple = false,
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
        return view('components.select', [
            'label' => $this->label,
            'id' => $this->id,
            'name' => $this->name,
            'prepand' => $this->prepand,
            'append' => $this->append,
            'placeholder' => $this->placeholder,
            'options' => $this->options,
            'value' => $this->value,
            'route' => $this->route,
            'classInput' => $this->classInput,
            'multiple' => $this->multiple,
            'required' => $this->required,
            'disabled' => $this->disabled,
            'readonly' => $this->readonly,
        ]);
    }
}
