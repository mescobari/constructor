<?php

namespace App\Models\BackEnd\intervenciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_at', 
        'updated_at',     
        'path_proyecto',
       
    ];   
}
