<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $contacts = Contact::where('status', 'ativo')
                    ->get();
        return response()
                ->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = Contact::create($request->validated());

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
    public function show($id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
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

        $validated =   $request->validated();

        $contact->update($validated);
        return response()->json([
            'message' => 'Contato atualizado com sucesso'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'inativo';
        $contact->save();

        return response()->json(null, 204);
    }

  
}