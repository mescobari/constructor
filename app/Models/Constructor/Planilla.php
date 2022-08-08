<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_planilla_id', 'fecha_planilla', 'contrato_id','numero_planilla', 'nuri_planilla',
     'referencia', 'path_planilla', 'total_planilla','anticipo_planilla', 'retencion_planilla' ];

	protected $table = 'planillas';

}
