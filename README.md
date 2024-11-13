# API Backend - Projeto de Autenticação e Registro

Este é um exemplo de uma API backend simples construída com **Laravel**. O projeto simula a autenticação de usuários, registro e listagem com validações de dados. A seguir estão descritas as rotas disponíveis e como testar a API.

## Requisitos

- PHP 7.4 ou superior
- Composer
- Laravel 8 ou superior
- MySQL (opcional, se necessário para persistir os dados)

## Instalação

1. Clone o repositório para sua máquina local:
    ```bash
    git clone https://github.com/SEU_USUARIO/api-backend.git
    ```

2. Instale as dependências do Laravel:
    ```bash
    cd api-backend
    composer install
    ```

3. Configure seu ambiente (crie um `.env` com as configurações apropriadas):
    ```bash
    cp .env.example .env
    ```

4. Gere a chave de aplicação:
    ```bash
    php artisan key:generate
    ```

5. Rode o servidor localmente:
    ```bash
    php artisan serve
    ```

A API estará disponível em: `http://127.0.0.1:8000`.

## Endpoints

### 1. **Login de Usuário**

**Rota:** `POST /api/acessar`

Essa rota autentica um usuário com base no e-mail e senha fornecidos.

#### Requisição:
```json
{
    "email": "usuario1@example.com",
    "senha": "123456"
{
```

**Response**
Success (200)
```json
Copy code
{
  "status": "success",
  "message": "Login bem-sucedido",
  "data": {
    "email": "usuario1@example.com"
  }
}```
Error (401): Invalid credentials.
json
Copy code
{
  "status": "error",
  "message": "Credenciais inválidas"
}
2. POST /api/registrar
This endpoint registers a new user with an email, password, and birth date. It also validates that the user is at least 18 years old.

Request
Method: POST
URL: /api/registrar
Body Parameters:
email (string) required: The email of the user (must be a valid email format).
dt_nascimento (date) required: The date of birth of the user (must be a valid date format).
senha (string) required: The password of the user (minimum length: 6 characters).
Example Request
json
Copy code
{
  "email": "newuser@example.com",
  "dt_nascimento": "2000-01-01",
  "senha": "newpassword123"
}
Response
Success (201)
json
Copy code
{
  "status": "success",
  "message": "Usuário registrado com sucesso!",
  "data": {
    "email": "newuser@example.com",
    "dt_nascimento": "2000-01-01",
    "senha": "newpassword123"
  }
}
Error (400): If the email is already registered or if the user is under 18 years old.
json
Copy code
{
  "status": "error",
  "message": "O e-mail informado já está registrado."
}
or

json
Copy code
{
  "status": "error",
  "message": "Você precisa ter 18 anos ou mais para se registrar."
}
3. GET /api/listagem-usuarios
This endpoint retrieves a paginated list of all registered users.

Request
Method: GET
URL: /api/listagem-usuarios
Query Parameters:
page (integer) optional: The page number for pagination (default is 1).
per_page (integer) optional: The number of users to return per page (default is 5).
Example Request
http
Copy code
GET /api/listagem-usuarios?page=2&per_page=5
Response
Success (200)
json
Copy code
{
  "status": "success",
  "data": [
    {
      "email": "usuario6@example.com",
      "dt_nascimento": "2001-03-11",
      "senha": "password2"
    },
    {
      "email": "usuario7@example.com",
      "dt_nascimento": "2002-08-05",
      "senha": "password3"
    },
    {
      "email": "usuario8@example.com",
      "dt_nascimento": "1997-12-14",
      "senha": "password4"
    },
    {
      "email": "usuario9@example.com",
      "dt_nascimento": "1994-09-20",
      "senha": "password5"
    },
    {
      "email": "usuario10@example.com",
      "dt_nascimento": "1989-06-17",
      "senha": "password6"
    }
  ],
  "meta": {
    "page": 2,
    "per_page": 5,
    "total": 10
  }
}







