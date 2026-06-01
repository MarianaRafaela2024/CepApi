# CepApi
CEP API
API REST para consulta, cadastro e remoção de CEPs, desenvolvida em PHP com PDO e interface web integrada para testes.

Estrutura do projeto
CepApi/
├── api/
│   └── cep.php
│   └── cep.html
├── config/
    └── database.php
├── README.md
├── cep.sql


Requisitos
Para rodar o projeto você vai precisar de PHP 7.4 ou superior, MySQL 5.7 ou superior, um servidor local como XAMPP, WAMP ou Laragon, e o PDO habilitado no PHP.

Configuração do banco de dados
Abra o arquivo config/database.php e substitua as credenciais pelas suas:
php$host     = "localhost";
$db_name  = "nome_do_seu_banco";
$user     = "seu_usuario";
$password = "sua_senha";
Depois, execute o SQL indicado no cep.sql para criar a tabela necessária:


Endpoints
A URL base da API é http://localhost/CepApi/api/cep.php. O CEP pode ser informado com ou sem hífen em todos os endpoints — a API trata isso automaticamente.
GET — busca os dados de um CEP cadastrado.
GET /api/cep.php?cep=13382543
POST — cadastra um novo CEP. O corpo deve ser enviado em JSON com os campos cep, logradouro, bairro, cidade e uf. Todos são obrigatórios. Retorna status 201 em caso de sucesso ou 400 se algum campo estiver faltando.
POST /api/cep.php
Content-Type: application/json

{
  "cep": "13382-543",
  "logradouro": "Rua Dulce Maria Sampaio",
  "bairro": "Jardim Flamboyant",
  "cidade": "Nova Odessa",
  "uf": "SP"
}
DELETE — remove um CEP pelo número. Retorna 404 caso o CEP não seja encontrado.
DELETE /api/cep.php?cep=13382543

Interface web
O arquivo cep.html é uma interface visual para testar os três endpoints sem precisar de ferramentas externas como o Postman. Basta abrir no navegador com a API já rodando no servidor local. A URL da API está definida no topo do script:
javascriptconst API_URL = 'http://localhost/CepApi/api/cep.php';
Altere esse valor se o projeto estiver em um caminho diferente.