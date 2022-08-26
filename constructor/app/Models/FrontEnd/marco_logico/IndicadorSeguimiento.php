<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorSeguimiento extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'indicador_planificacion_id', 'fecha', 'gestion', 'move_indicator_type_id', 'concepto', 'valor_medido', 'glosa', 'pathDocumento', 'informe_seguimiento_id' ];
	protected $table = 'indicador_seguimiento';
}
