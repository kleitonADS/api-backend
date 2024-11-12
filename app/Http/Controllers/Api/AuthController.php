<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Simulando um banco de dados fictício
    private $users = [
        ['email' => 'usuario1@example.com', 'senha' => '123456', 'dt_nascimento' => '2000-05-15'],
        ['email' => 'usuario2@example.com', 'senha' => 'abcdef', 'dt_nascimento' => '1990-08-22'],
        ['email' => 'usuario3@example.com', 'senha' => 'abcdef', 'dt_nascimento' => '1995-04-01'],
        ['email' => 'usuario4@example.com', 'senha' => '123456', 'dt_nascimento' => '1992-07-19'],
        ['email' => 'usuario5@example.com', 'senha' => 'password1', 'dt_nascimento' => '1999-11-30'],
        ['email' => 'usuario6@example.com', 'senha' => 'password2', 'dt_nascimento' => '2001-03-11'],
        ['email' => 'usuario7@example.com', 'senha' => 'password3', 'dt_nascimento' => '2002-08-05'],
        ['email' => 'usuario8@example.com', 'senha' => 'password4', 'dt_nascimento' => '1997-12-14'],
        ['email' => 'usuario9@example.com', 'senha' => 'password5', 'dt_nascimento' => '1994-09-20'],
        ['email' => 'usuario10@example.com', 'senha' => 'password6', 'dt_nascimento' => '1989-06-17'],
    ];

    // Função para verificar a idade de um usuário
    private function verificarIdade($dataNascimento)
    {
        $dataNascimento = Carbon::parse($dataNascimento)->setTimezone('America/Sao_Paulo');
        $dataAtual = Carbon::now('America/Sao_Paulo');

        $idade = $dataAtual->diffInYears($dataNascimento , true);

        if ($dataAtual->month < $dataNascimento->month ||
            ($dataAtual->month == $dataNascimento->month && $dataAtual->day < $dataNascimento->day)) {
            $idade--;
        }

        return $idade;
    }

    // Função de login: Verifica se o usuário existe
    public function acessar(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:6'
        ]);

        // Simulação de busca no banco de dados fictício
        foreach ($this->users as $user) {
            if ($user['email'] == $request->email && $user['senha'] == $request->senha) {
                // Retorna a autenticação com sucesso
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login bem-sucedido', // Message indicating success
                    'data' => [
                        'email' => $user['email'], // Include relevant data (email)
                    ]
                ], 200);
            }
        }

        // Caso não encontre o usuário
        return response()->json([
            'status' => 'error',
            'message' => 'Credenciais inválidas', // Message indicating error
        ], 401);
    }

    // Função para registrar um novo usuário
    public function registrar(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'dt_nascimento' => 'required|date',
            'senha' => 'required|min:6',
        ]);

        // Verifica se o e-mail já existe no banco fictício
        foreach ($this->users as $user) {
            if ($user['email'] == $request->email) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'O e-mail informado já está registrado.'
                ], 400);
            }
        }

        // Verificando a idade do usuário
        $idade = $this->verificarIdade($request->dt_nascimento);

        if ($idade < 18) {
            return response()->json([
                'status' => 'error',
                'message' => 'Você precisa ter 18 anos ou mais para se registrar.'
            ], 400);
        }

        // Simulando a inserção de um novo usuário
        $newUser = [
            'email' => $request->email,
            'senha' => $request->senha,
            'dt_nascimento' => $request->dt_nascimento,
        ];

        $this->users[] = $newUser;

        // Resposta de sucesso
        return response()->json([
            'status' => 'success',
            'message' => 'Usuário registrado com sucesso!',
            'data' => $newUser // Include the new user data
        ], 201);
    }

    // Função para listar todos os usuários registrados
    public function listagemUsuarios(Request $request)
    {
        $perPage = max(1, (int)$request->query('per_page', 5)); // No mínimo 1 item por página
        $page = max(1, (int)$request->query('page', 1)); // Página mínima 1

        $offset = ($page - 1) * $perPage;
        $paginatedUsers = array_slice($this->users, $offset, $perPage);

        return response()->json([
            'status' => 'success',
            'data' => $paginatedUsers,
            'meta' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => count($this->users)
            ]
        ], 200);
    }
}
