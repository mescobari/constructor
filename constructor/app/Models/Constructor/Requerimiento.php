<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'tipo_requerimiento_id',
        'correlativo_requerimiento',
        'fecha_requerimiento',
        'nuri_requerimiento',
        'descripcion_requerimiento',
        'trabajos_encarados',
        'gastos_generales',
        'path_requerimientos',
    ];
}
