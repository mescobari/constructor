<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorResultado extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'resultados_id', 'indicadores_id' ];
	protected $table = 'indicadores_resultados';
    
    public function indicador_planificaciones(){
        return $this->hasMany(IndicadorPlanificacion::class, 'indicadores_resultados_id', 'id');
    }
}
