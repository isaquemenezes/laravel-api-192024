# laravel-api

## Clone o Repositório e acesse 
```
git clone https://github.com/isaquemenezes/laravel-api-192024.git
cd api
```

## Crie o Arquivo .env
```
cp .env.example .env
```

## Atualize as variáveis de ambiente do arquivo .env e Configure seu Banco favorito(aqui estamos com Postgres):
```
DB_CONNECTION=pgsql
DB_HOST=database-pg
DB_PORT=5432

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
``` 
## Suba os containers do projeto
```
docker-compose up -d
```
## Acesse ao Container
```
docker-compose exec app bash
```
## Instale as dependencias
```
composer install
```

## Gerar a key do projeto Laravel
```
php artisan key:generate
```

## Rodar Migrations e Seeds em Sequência
```
php artisan migrate --seed
```

## Se preferi Rode as Migrates:
```
php artisan migrate
```

## Execute as seeds:
```
php artisan db:seed 
```


## Teste a Aplicação | navegador| Postman| Ferramenta como o curl:
```
curl http://127.0.0.1:8000/
```
## API Doc
- GET /contacts — Listar todos os contatos.
- POST /contacts — Criar um novo contato
```
{
    "nome": "Pessoa Teste",
    "email": "pessoateste@example.com",
    "telefone": "91 922014636",
    "cep": "58390-970"
}
```
- GET /contacts/{id} — Exibir detalhes de um contato.
- PUT/PATCH /contacts/{id} — Atualizar um contato existente.
```
{
    "nome": "Pessoa Teste Editado",
    "email": "pessoateste@example.com",
    "telefone": "91922014636",
    "cep": "58390970"   
}
```
- DELETE /contacts/{id} — Deletar um contato.

- GET /contacts/search?nome=nome - Busque um contato pelo nome
- GET /contacts/search?email=email@example.com - Busca pelo e-mail
- GET /contacts/search?nome=nome&email=nome@example.com - Busca tanto por nome quanto por e-mail:


1. GET /contacts
<img src="/preview/getContacts.png">

2. GET /contacts/{id} — Exibir detalhes de um contato.
<img src="/preview/getContactsId.png">

3. buscas
<div style="display: flex; justify-content: space-between;">
  <img src="/preview/searchEmail.png" alt="" style="width: 45%;">
  <img src="/preview/searchNome.png" alt="" style="width: 45%;">
</div>

## Requisitos :trophy:

1. Adicionar Contatos :heavy_check_mark: <br> 
2. Buscar Contatos :heavy_check_mark: <br>
3. Registrar Contatos :heavy_check_mark: <br>
4. Endpoint :heavy_check_mark: <br>
5. Filtrar Contatos por nome e email :heavy_check_mark: <br>

## Validaçoes implementadas 🚀

1. Email :heavy_check_mark: <br> 
2. CEP :heavy_check_mark: <br>
3. Nome :heavy_check_mark: <br>
4. Telefone :heavy_check_mark: <br>

## Testes Unitários com PHPUnit
```
php artisan test
```


## Notas
1. :warning: As mensagens de erro nao são exibidas - para testes via json(Postman) 
- Accept application/json
- Content-Type application/json

### Tecnologias :books:

- [via Cep](https://viacep.com.br/)
- [Postman](https://www.postman.com/)
- [Visual Studio Code](https://code.visualstudio.com/)
- [Git](https://git-scm.com/)
- [GiHub](https://github.com/)
- [Laravel | 10](https://laravel.com/)
- [PHP | 8.1 ](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://docs.docker.com//)
- [WSL](https://learn.microsoft.com/pt-br/windows/wsl/install/)
- [PostgreSQL](https://www.postgresql.org/)