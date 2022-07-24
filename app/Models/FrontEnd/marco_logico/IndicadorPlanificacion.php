<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorPlanificacion extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'indicadores_resultados_id', 'gestion', 'fecha_inicial', 'fecha_final', 'indicador_frecuencia_id', 'valor_inicial', 'valor_final', 'glosa', 'pathDocumento' ];
	protected $table = 'indicador_planificacion';

    public function frecuencias(){
        return $this->belongsTo(FrecuenciaMedicion::class, 'indicador_frecuencia_id');
    }
}
