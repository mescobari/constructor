<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FrontEnd\marco_logico\FrecuenciaMedicion;
use App\Models\FrontEnd\marco_logico\UnidadMedida;

class Indicador extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'nombre', 'descripcion', 'frecuencia', 'variables', 'calculo', 'unidades_id', 'medios_verificacion' ];
	protected $table = 'indicadores';

    public function unidades(){
        return $this->belongsTo(UnidadMedida::class, 'unidades_id');
    }

    public function frecuencias(){
        return $this->belongsTo(FrecuenciaMedicion::class, 'frecuencia');
    }
}
