<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'id',
        'ci',
        'complemento',
        'expedido',
        'nombres',
        'paterno',
        'materno',
        'direccion',
        'telefono',
        'celular',
        'sexo	',
        'fecha_nacimiento',
        'codigo_persona',
        'created_at',
        'updated_at',
    ];   
}
