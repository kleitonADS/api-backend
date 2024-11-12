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


## Endpoints

### 2. Registro de Novo Usuário

**Rota:** `POST /api/registrar`

Essa rota autentica um usuário com base no e-mail e senha fornecidos.

#### Requisição:
```json
{
    "email": "novo_usuario@example.com",
    "senha": "senha123",
    "dt_nascimento": "2000-01-01"
}
```

## Endpoints

### 3. Listagem de Usuários

**Rota:** GET /api/listagem-usuarios

Essa rota autentica um usuário com base no e-mail e senha fornecidos.

#### Requisição:
GET /api/listagem-usuarios?page=1&per_page=5







