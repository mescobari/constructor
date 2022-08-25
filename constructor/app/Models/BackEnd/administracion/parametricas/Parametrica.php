<?php

namespace App\Models\BackEnd\administracion\parametricas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametrica extends Model
{
    use HasFactory;
    
    protected $table = "parametricas";
    protected $fillable = 
    [
        'id', 
        'id_padre', 
        'codigo', 
        'valor', 
        'grupo', 
        'descripcion', 
        'modificable', 
        'json', 
        'estado', 
        'user_create', 
        'user_update', 
        'user_delete', 
        'created_at', 
        'updated_at',
        'deleted_at',
    ];
}
