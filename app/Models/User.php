<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // A tabela que este modelo irá manipular (se for diferente de 'users')
    protected $table = 'usuarios';

    // Os campos que podem ser preenchidos em massa
    protected $fillable = [
        'email', 'dt_nascimento', 'senha'
    ];
}
