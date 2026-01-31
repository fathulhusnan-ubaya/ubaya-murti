<?php

namespace App\Rules;

use App\Models\Menu;
use Illuminate\Contracts\Validation\Rule;

class MaxUrutanMenuRule implements Rule
{
    private int $max;

    private int $addition;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private ?int $idMenu)
    {
        $this->addition = 1;
        if (! empty($idMenu)) {
            $menu = Menu::findOrFail($idMenu);
            if ($menu->Parent == request()->induk) {
                $this->addition = 0;
            }
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! request()->has('induk')) {
            $this->max = (Menu::whereNull('IdMenuParent')->orderByDesc('Urutan')->first()['Urutan'] ?? 0) + $this->addition;
        } else {
            $this->max = (Menu::where('IdMenuParent', request()->induk)->orderByDesc('Urutan')->first()['Urutan'] ?? 0) + $this->addition;
        }

        return $value <= $this->max;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $current = $this->max - $this->addition;

        return ":Attribute tidak boleh lebih dari {$this->max}. Saat ini hanya ada $current menu di menu terpilih.";
    }
}
