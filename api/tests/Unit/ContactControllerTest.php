<?php

namespace Tests\Unit;

// namespace Tests\Unit\Http\Controllers\Api;

use App\Http\Controllers\Api\ContactController;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;


class ContactControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $contactController;

    public function setUp(): void
    {
        parent::setUp();
        // Popula o banco de dados com 10 contatos de teste
        Contact::factory()->count(5)
            ->create(['status' => 'ativo']);
        Contact::factory()->count(3)
            ->create(['status' => 'inativo']);

        // Mock do serviço ContactService
        $serviceMock = Mockery::mock(ContactService::class);

        // Instância do controlador com o mock do serviço
        $this->contactController = new ContactController($serviceMock);
    }

     /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Testa se o método index retorna apenas contatos ativos.
     *
     * @return void
     */
    public function test_retorna_contatos_ativos_index()
    {
    
        $response = $this->getJson('/contacts');

        // Verificacçoes
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');

        $contacts = $response->json('data');
        foreach ($contacts as $contact) 
        {
            $this->assertEquals('ativo', $contact[
                'status'
            ]);
        }
    }
    /** @test */
    public function test_encontrar_contato_especifico_show()
    {
        $contact = Contact::factory()->create();

        $response = $this->getJson(route(
        'contacts.show', 
        $contact->id
        ));

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $contact->id,
                'nome' => strtoupper($contact->nome),
                'email' => $contact->email,
                'telefone' => $contact->telefone,
                'endereco' => $contact->endereco
            ]
        ]);
    }
    
    /** @test */
    public function test_return_404_contato_NotFound()
    {
        $response = $this->getJson(route(
            'contacts.show', 
            919
        ));

        $response->assertStatus(404);
    }

    /** @test */
    public function test_delete_contato_update_status_inativo()
    {        
        $contact = Contact::factory()->create([
            'status' => 'ativo',
        ]);

        $response = $this->deleteJson(route(
        'contacts.destroy', 
        $contact->id
        ));

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Contato excluído com sucesso!',
        ]);

        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'status' => 'inativo'
        ]);
    }

    /** @test */
    public function test_insercao_novo_contato_store()
    {
        $requestData = [
            'nome' => 'João Silva',
            'email' => 'joaosi@example.com',
            'telefone' => '999999999',
            'cep' => '76967-644'
        ];
     
        $cepData = [
            'endereco' => '	Travessa Machado de Assis',
            'bairro' => 'Industrial',
            'cidade' => 'Cacoal',
            'estado' => 'RO'
        ];

        // Mock do ContactRequest para validar os dados simulados
        $requestMock = Mockery::mock(ContactRequest::class);
        $requestMock->shouldReceive('validated')->andReturn($requestData);

        // Mock do ContactService para retornar dados de endereço com base no CEP
        $serviceMock = Mockery::mock(ContactService::class);
        $serviceMock->shouldReceive('buscarEnderecoPorCep')
            ->with('76967-644')
            ->andReturn($cepData); 

        $controller = new ContactController($serviceMock);

        $response = $controller->store($requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
       
        $responseData = $response->getData(true);
        $this->assertEquals('Contato criado com sucesso!', $responseData['message']);

        $this->assertDatabaseHas('contacts', [
            'nome' => 'João Silva',
            'email' => 'joaosi@example.com'
           
          
        ]);
    }

    /** @test */      
    public function test_update_contato()
    {
        // Mock do serviço de validação da requisição
        $requestMock = Mockery::mock(ContactRequest::class);
        $requestData = [
            'nome' => 'Nome Atualizado',
            'email' => 'atualizado@example.com',
            'telefone' => '999999999',
            'cep' => '76967-644'
        ];
        
        $requestMock->shouldReceive('validated')
            ->andReturn($requestData);

        // Mock do modelo Contact
        $contactMock = Mockery::mock(Contact::class);
        $contactMock->shouldReceive('update')
            ->with($requestData)
            ->once()
            ->andReturnTrue();

        $response = $this->contactController->update($requestMock, $contactMock);

        // Verificar a resposta
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
        '{"message":"Contato atualizado com sucesso"}', 
        $response->getContent()
        );
    }

    /** @test */
    public function test_search_by_EmailNome()
    {
        // Mock da requisição, parâmetros 'nome' e 'email'
        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('validate')->once()->andReturn([
            'nome' => 'Naruto Uzumaki',
            'email' => 'narutouzumaki@example.com'
        ]);

        // Mock do resultado esperado do serviço
        $resultEsperadoContat = new Collection([
            [
                'id' => 1, 
                'nome' => 'Naruto Uzumaki', 
                'email' => 'narutouzumaki@example.com', 
                'telefone' => '999999999'
            ]
        ]);

        // Mock da função searchEmailNome no serviço
        $serviceMock = Mockery::mock(ContactService::class);
        $serviceMock->shouldReceive('searchEmailNome')
            ->with($requestMock)
            ->once()
            ->andReturn($resultEsperadoContat);

        // Substituir o serviço no controlador pelo mock
        $this->contactController = new ContactController($serviceMock);

        $response = $this->contactController->searchByEmailNome($requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'message' => 'Busca realizada com sucesso!',
            'data' => $resultEsperadoContat]
        ), $response->getContent());
    }


    protected function tearDown(): void
    {
        Mockery::close(); // Fecha os mocks após os testes
        parent::tearDown();
    }

}
        

     