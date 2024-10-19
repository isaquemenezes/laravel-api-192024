# laravel-api

## Acesse ao Container
```
docker-compose exec app bash
```

## Configure seu Banco favorito(aqui estamos com Postgres):
```
DB_CONNECTION=pgsql
DB_HOST=database-pg
DB_PORT=5432

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
``` 

## Instale as dependencias
```
composer install

```

## Rode as Migrates:
```
php artisan migrate
```

## Execute as seeds:
```
php artisan db:seed 
```

## Rodar Migrations e Seeds em Sequência
```
php artisan migrate --seed
```

## Teste a Aplicação | navegador| Postman| Ferramenta como o curl:
```
curl http://127.0.0.1:8000/
```
## API Doc
- GET /users — Listar todos os contatos.
- POST /users — Criar um novo contato
- GET /users/{id} — Exibir detalhes de um contato.
- PUT/PATCH /users/{id} — Atualizar um contato existente.
- DELETE /users/{id} — Deletar um usuário.

1. GET /users
<img src="/preview/getUsers.png">

2. GET /users/{id} — Exibir detalhes de um contato.
<img src="/preview/getUserId.png">

### Tecnologias

- [via Cep](https://viacep.com.br/)
- [Postman](https://www.postman.com/)
- [Visual Studio Code](https://code.visualstudio.com/)
- [Git](https://git-scm.com/)
- [GiHub](https://github.com/)
- [PHP | 8.1.27 ](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Bootstrap 5.3](https://getbootstrap.com/)
- [PostgreSQL](https://www.postgresql.org/)