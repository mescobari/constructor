<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'objetivos_id', 'desc_corta', 'descripcion' ];
	protected $table = 'resultados';

    public function indicador_resultados(){
        return $this->hasMany(IndicadorResultado::class, 'resultados_id', 'id')->with('indicador_planificaciones');
    }
}
