<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivilegeRequest extends FormRequest
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
            'role' => ['required'],
            'menu' => ['required'],
            'level' => ['required', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'role' => 'Role',
            'menu' => 'Menu',
            'level' => 'Level',
        ];
    }
}
