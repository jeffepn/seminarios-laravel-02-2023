<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isNotPost = $this->method() !== 'POST';
        $sometimes = $isNotPost ? 'sometimes' : '';
        $unique = $isNotPost
            ? Rule::unique('products', 'name')
                ->ignore($this->product->id, 'id')
            : Rule::unique('products', 'name');
        return [
            'name' => [
                $sometimes,
                'required',
                'max:50',
                $unique
            ],
            'price' => [$sometimes, 'required', 'numeric', 'max:999999.99']
        ];
    }

    /**
     * This method adding custom validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => "O campo de :attribute deve ser um número válido.",
            'max' => "Forneça um número para o campo :attribute menor ou igual a :max.",
            'name.max' => "Limite o campo :attribute a no máximo :max caracteres.",
            'name.unique' => "Este nome de produto já esta sendo utilizado.",
        ];
    }

    /**
     * This method adding custom attribute names
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'price' => "preço",
            'name' => "nome",
        ];
    }
}