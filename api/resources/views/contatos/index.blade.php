<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>

    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
   
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Contatos Ativos</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr class="table-primary" >
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                </tr>
            </thead>
            <tbody id="contatos-list">
                <!-- Dados -->
            </tbody>
        </table>
    </div>

    <script>
        async function fetchContatos() 
        {
            try 
            {
                const response = await fetch('/api/contacts');
                const contacts = await response.json();

                let contatosList = document.getElementById('contatos-list');
                contatosList.innerHTML = ''; 
                console.log('contacts ---> ',contacts);                

                contacts.data.forEach(contact => {
                    let row = `<tr  class="table-success">
                       
                        <td>${contact.nome}</td>
                        <td>${contact.email}</td>
                        <td>${contact.telefone}</td>
                        <td>${contact.endereco}</td>
                    </tr>`;
                    contatosList.innerHTML += row;
                });
            } catch (error) {
                console.error('Erro ao buscar os contatos:', error);
            }
        }

        // Chama a função quando a página é carregada
        document.addEventListener('DOMContentLoaded', fetchContatos);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>