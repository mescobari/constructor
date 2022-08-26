<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadEjecutora extends Model
{
    use HasFactory;
    protected $fillable = ['institucion_id', 'unidad_ejecutora','dir_admin_id', 'nombre',
    'palabras_clave', 'fecha_inicial','fecha_final', 'estado' ];

	protected $table = 'unidades_ejecutoras';
    
}
