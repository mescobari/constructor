<?php

namespace App\Models\FrontEnd\Poa\Seguimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FrontEnd\cofinanciadores\TipoDocumento;
use App\Models\FrontEnd\Poa\Seguimiento\TipoMovimientoIndicador;

class InformeSeguimiento extends Model
{
    use HasFactory;
    protected $fillable = ['id','intervenciones_id', 'move_indicator_type_id', 'document_type_id', 'gestion',  'fecha',  'referencia',  'descripcion',  'funcionarios_id' ];
	protected $table = 'informe_seguimiento';
    
    public function tipo_movimiento(){
        return $this->belongsTo('App\Models\FrontEnd\Poa\Seguimiento\TipoMovimientoIndicador', 'move_indicator_type_id');
    }
    public function tipo_documento(){
        return $this->belongsTo('App\Models\FrontEnd\cofinanciadores\TipoDocumento', 'document_type_id');
    }
}
