<?php

namespace App\Models\FrontEnd\intervenciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\FrontEnd\intervenciones\InterventionType;
use App\Models\FrontEnd\intervenciones\ClaSectorial;

class Intervencion extends Model
{
    use HasFactory;

    protected $table = 'intervenciones';
    protected $fillable = [
        'id',
        'institucion_id',
        'inteventiontype_id',
        'nombre',        
        'codsisin',   
        'sectorial_id',  
        'fecha_aprobacion',  
        'fecha_inicial_programada',  
        'duracion_dias',  
        'fecha_inicial_real',  
        'descripcion',  
        'monto_aprobado_bs',   
        'monto_aprobado_dolares', 
        'path_proyecto',
        'created_at', 
        'updated_at',            
    ];   
    public function institucion(){
        return $this->belongsTo(ClaInstitucional::class, 'institucion_id', 'id');
    }
    public function tipo_intervencion(){
        return $this->belongsTo(InterventionType::class, 'inteventiontype_id', 'id');
    }
    public function sectorial(){
        return $this->belongsTo(ClaSectorial::class, 'sectorial_id', 'id');
    }
}
