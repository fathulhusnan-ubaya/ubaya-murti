<?php

namespace App\Http\Requests;

use App\Rules\MaxUrutanMenuRule;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'judul' => ['required'],
            'route_name' => ['required'],
            'induk' => ['nullable', 'numeric'],
            'urutan' => ['required', 'numeric', 'min:1', new MaxUrutanMenuRule($this->getMethod() == 'PUT' ? collect(explode('/', $this->getPathInfo()))->last() : null)],
            'is_aktif' => ['bool'],
        ];
    }

    public function attributes()
    {
        return [
            'judul' => 'Judul',
            'route_name' => 'Route name',
            'route_param_key' => 'Route param key',
            'route_param_value' => 'Route param value',
            'induk' => 'Menu induk',
            'urutan' => 'Urutan',
            'icon' => 'Icon',
            'is_aktif' => 'Aktif',
        ];
    }
}
