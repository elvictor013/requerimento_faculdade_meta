<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorRequest extends FormRequest
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
        return [
            'nome' => 'required|unique:setor,nome',
            'descricao' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório!',
            'nome.unique' => 'O nome do setor ja foi cadastrado!',
            'descricao.required' => 'O campo descrição é obrigatório!',
        ];
    }
}
