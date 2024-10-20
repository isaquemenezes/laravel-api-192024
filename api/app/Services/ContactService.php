<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ContactService
{
    /**
     * Consulta a API ViaCEP e retorna os dados do endereço.
     *
     * @param string $cep
     * @return array|null
     */
    public function buscarEnderecoPorCep(string $cep): ?array
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful()) 
        {
            $data = $response->json();

            if (!isset($data['erro'])) {
                return [
                    'estado' => $data['uf'] ?? null,
                    'cidade' => $data['localidade'] ?? null,
                    'bairro' => $data['bairro'] ?? null,
                    'endereco' => $data['logradouro'] ?? null,
                ];
            }
        }

        return null; 
    }

    /**
     * Busca contatos pelo nome e email.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchEmailNome(Request $request): Collection
    {
        $query = Contact::query();
        
        if ($request->filled('nome')) {
            $query->where('nome', 'LIKE', '%' . $request->nome . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        return $query->get();
    }
}
