<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequerimientoItem extends Model
{
    use HasFactory;
protected $fillable = [
    'requerimiento_id',
    'requerimiento_recurso_id',
    'cantidad_recurso',
    'horas_recurso',
    'dias_recurso',
    'tiempo_total_recurso',
    'precio_referencia_recurso'

];
}
