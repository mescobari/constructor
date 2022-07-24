<?php

namespace App\Models\FrontEnd\usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionarios';
    protected $fillable = [
        'id',
        'institucion_id',
        'persona_id',
        'users_id',
        'fecha_inicial',
        'fecha_final',
        'created_at',
        'updated_at',
    ];   
}
