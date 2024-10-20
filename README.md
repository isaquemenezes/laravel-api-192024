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
- GET /contacts/{id} — Exibir detalhes de um contato.
- PUT/PATCH /contacts/{id} — Atualizar um contato existente.
- DELETE /contacts/{id} — Deletar um contato.

- GET /contacts/search?nome=nome - Busque um contato pelo nome
- GET /contacts/search?email=email@example.com - Busca pelo e-mail
- GET /contacts/search?nome=nome&email=nome@example.com - Busca tanto por nome quanto por e-mail:


1. GET /contacts
<img src="/preview/getContacts.png">

2. GET /contacts/{id} — Exibir detalhes de um contato.
<img src="/preview/getContactsId.png">

## Requisitos :trophy:

Adicionar Contatos :heavy_check_mark: 
Buscar Contatos :heavy_check_mark: 
Registrar Contatos :heavy_check_mark: 
Endpoint :heavy_check_mark: 
filtrar Contatos por nome e email :heavy_check_mark: 


### Tecnologias :books:

- [via Cep](https://viacep.com.br/)
- [Postman](https://www.postman.com/)
- [Visual Studio Code](https://code.visualstudio.com/)
- [Git](https://git-scm.com/)
- [GiHub](https://github.com/)
- [PHP | 8.1 ](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Bootstrap 5.3](https://getbootstrap.com/)
- [PostgreSQL](https://www.postgresql.org/)