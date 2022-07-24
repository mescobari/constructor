<?php

namespace App\Models\FrontEnd\estructura_financiamiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\estructura_financiamiento\Presupuestario;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;

class ComprobanteDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['id','comprobante_encabezado_id', 'objetivos_id',  'cla_presupuestario_id', 'cofinanciadores_id', 'concepto', 'monto_bs', 'monto_Sus' ];
	protected $table = 'comprobante_detalle';
    
    public function componentes(){
        return $this->belongsTo(Objetivo::class, 'objetivos_id');
    }
    
    public function partidas(){
        return $this->belongsTo(Presupuestario::class, 'cla_presupuestario_id');
    }
    
    public function cofinanciadores(){
        return $this->belongsTo(Cofinanciador::class, 'cofinanciadores_id')->with('cofinanciador_documento', 'institucion');
    }
}
