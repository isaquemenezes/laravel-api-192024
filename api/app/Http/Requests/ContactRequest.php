<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;

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
            'nome' => 'required|string|min:3|max:55',
            'email' => [
                'nullable',
                'email',
                Rule::unique('contacts', 'email')
                    ->ignore($this->contact),
            ],         
            'telefone' => 'nullable|string|min:10|max:12',
            'cep' => 'required|string',
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
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter mais de 3 caracteres.',
            'telefone.max' => 'O telefone não pode ter mais de 12 caracteres.',
            'telefone.min' => 'O telefone não pode ter menos de 10 caracteres.',
            'cep.required' => 'O CEP é obrigatório.',
                      
        ];
    }

      /**
     * Valida o CEP chamando a API da ViaCEP.
     *
     * @param \Illuminate\Validation\Validator $validator
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $cep = $this->cep;

            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->failed() || isset($response->json()['erro'])) {
                $validator->errors()->add('cep', 'CEP inválido ou não encontrado!');
            }
        });
    }


}