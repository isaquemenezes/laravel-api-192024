<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $contacts = Contact::where('status', 'ativo')
                    ->get();

        return ContactResource::collection($contacts)->response();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request): JsonResponse
    {
       
        $validatedData = $request->validated();

        $cepData = $this->contactService->buscarEnderecoPorCep($validatedData['cep']);

        if ($cepData){

            $validatedData = array_merge($validatedData, $cepData);
        }

        $contact = Contact::create($validatedData);

        return response()->json([
            'message' => 'Contato criado com sucesso!',
            'contact' => $contact
        ], 201);

    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        
        return (new ContactResource($contact))->response();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request,Contact $contact): JsonResponse
    {

        $validated = $request->validated();
        $contact->update($validated);

        return response()->json([
            'message' => 'Contato atualizado com sucesso'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'inativo';
        $contact->save();

        return response()->json([
            'message' => 'Contato excluído com sucesso!'
        ], 200);

    }

    public function searchByEmailNome(Request $request): JsonResponse
    {
        // Validação dos parâmetros 'nome' e 'email'
        $request->validate([
            'nome' => 'nullable|string|max:55',
            'email' => 'nullable|email|max:255',
        ]);       

        $contacts = $this->contactService->searchEmailNome($request);

        return response()->json([
            'message' => 'Busca realizada com sucesso!',
            'data' => $contacts
        ], 200);

    }


  
}