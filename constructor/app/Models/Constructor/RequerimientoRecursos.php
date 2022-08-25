<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequerimientoRecursos extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_requerimiento_id', 'codigo_recurso', 'descripcion_recurso','unidad_id', 
    'precio_referencial', 'unidad_contrato' ];

   protected $table = 'requerimiento_recursos';

}
