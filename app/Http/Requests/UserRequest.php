<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'nama' => ['required', 'max:191'],
            'Role' => ['required', 'array'],
        ];

        $passwordRules = array_filter($this->passwordRules(), fn ($rule) => $rule !== 'confirmed');

        if ($this->getMethod() == 'POST') { // add
            $rules['email'] = ['required', 'max:191', 'unique:User,Email'];
            $rules['username'] = ['required', 'max:20', 'unique:User,Username'];
            $rules['password'] = $passwordRules;
        } else { // update
            $passwordRules = array_filter($passwordRules, fn ($rule) => ! in_array($rule, ['required', 'string']));
            $rules['password'] = array_merge($passwordRules, ['nullable']);
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'username' => 'Username',
            'nama' => 'Nama',
            'password' => 'Password',
            'email' => 'Email',
        ];
    }
}
