<?php

namespace App\Models\FrontEnd\estructura_financiamiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobanteEncabezado extends Model
{
    use HasFactory;
    protected $fillable = ['id','intervenciones_id', 'fecha',  'gestion', 'move_finacial_type_id', 'concepto', 'glosa', 'pathDocumento' ];
	protected $table = 'comprobante_encabezado';
    
    public function tipos(){
        return $this->belongsTo(TiposMovimientos::class, 'move_finacial_type_id');
    }
    public function montoBS($id_encabezado){
        $valor = ComprobanteDetalle::where('comprobante_encabezado_id', $id_encabezado)->get()->sum('monto_bs');
        return $valor;
    }
    public function montoSUS($id_encabezado){
        $valor = ComprobanteDetalle::where('comprobante_encabezado_id', $id_encabezado)->get()->sum('monto_Sus');
        return $valor;
    }
}
