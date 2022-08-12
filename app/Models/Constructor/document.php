<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;
    protected $fillable = [
    'document_types_id',
    'unidad_ejecutora_id',
    'padre',
    'nombre',
    'codigo',
    'contratante_id',
    'contratado_id',
    'fecha_firma',
    'duracion_dias',
    'monto_bs',
    'objeto',
    'modifica',
    'path_contrato'
    ];
}
