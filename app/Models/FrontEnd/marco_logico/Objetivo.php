<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'intervenciones_id', 'objetivetype_id', 'padre', 'gestion', 'desc_corta', 'fecha_inicial_programada', 
    'fecha_final_programada', 'descripcion', 'duracion_dias', 'monto', 'tipo_ejecucion' ];
	protected $table = 'objetivos';    
    
    public function resultados(){
        return $this->hasMany(Resultado::class, 'objetivos_id', 'id')->with('indicador_resultados');
    }
}
 