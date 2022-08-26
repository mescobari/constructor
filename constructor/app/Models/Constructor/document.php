<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FrontEnd\cofinanciadores\TipoDocumento;

class document extends Model
{
    use HasFactory;
    protected $fillable = [
    'document_types_id',
    'unidad_ejecutora_id',
    'padre',
    'nombre',
    'codigo',
    'contratante_id',
    'contratado_id',
    'fecha_firma',
    'duracion_dias',
    'monto_bs',
    'objeto',
    'modifica',
    'path_contrato'
    ];


    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class, 'document_types_id', 'id');
    }

    public function getModificacion($contrato_id)
    {
        $json=document::where('padre',$contrato_id )->where('document_types_id',5 )
        ->with('tipo_documento')->get();
        $obj = json_decode($json, true);


        return $json;


    }


}
