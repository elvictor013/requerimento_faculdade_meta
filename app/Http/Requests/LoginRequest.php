<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine se o usuário tem permissão para fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obter as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|numeric',
            'password' => 'required|string',
        ];
    }

    /**
     * Obter as mensagens de erro personalizadas para cada validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'O campo identificação de usuário é obrigatório!',
            'username.numeric' => 'O campo identificação de usuário deve ser numérico!',
            'password.required' => 'O campo senha é obrigatório!',
        ];
    }
}
