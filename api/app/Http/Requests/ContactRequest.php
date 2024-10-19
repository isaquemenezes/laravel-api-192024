<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ContactRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'telefone' => preg_replace('/\D/', '', $this->telefone),
            'cep' => preg_replace('/\D/', '', $this->cep),
        ]);

        // dd($this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'nome' => 'required|string|max:55',
            'email' => [
                'nullable',
                'email',
                Rule::unique('contacts', 'email')->ignore($this->contact),
            ],
           
            'telefone' => 'nullable|string|max:12',
            'cep' => 'required|string|max:12',
            'estado' => 'nullable|string|max:25',
            'cidade' => 'nullable|string|max:55',
            'bairro' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'status' => 'in:ativo,inativo',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Por favor, insira um e-mail válido.',
            'email.unique' => 'O e-mail informado já está em uso.',
           
        ];
    }

}