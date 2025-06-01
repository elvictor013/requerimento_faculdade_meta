<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'username' => 'unique:users,username,' . ($userId ? $userId->id : null),
            //'email' => 'required|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required|confirmed|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'username.required' => 'Campo matrícula é obrigatório!',
            'username.unique' => 'A matrícula já está cadastrada!',
            'password.required' => 'Campo senha é obrigatório!',
            'password.confirmed' => 'A confirmação de senha não corresponde!',
            'password.min' => 'Senha com no mínimo :min caracteres!',
        ];
    }
}
