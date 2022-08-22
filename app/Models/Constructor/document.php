<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FrontEnd\cofinanciadores\TipoDocumento;
use App\Models\BackEnd\intervenciones\ClaInstitucional;

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
    public function contratante()
    {
        return $this->belongsTo(ClaInstitucional::class, 'contratante_id', 'id');
    }
    public function contratado()
    {
        return $this->belongsTo(ClaInstitucional::class, 'contratado_id', 'id');
    }
    public function getDocumento($id)
    {
        $documento = document::where('id',$id )
        ->with('contratante')->with('contratado')
        ->with('tipo_documento')
        ->first();

        return $documento;
    }



    public function getModificacion($contrato_id)
    {
        $items=[];
        $documento = $this->getDocumento($contrato_id );

        $items[0]['id']=$documento->id;
        $items[0]['nombre']=$documento->nombre;
        $items[0]['codigo']=$documento->codigo;
        $items[0]['fecha_firma']=$documento->fecha_firma;
        $items[0]['duracion_dias']=$documento->duracion_dias;
        $items[0]['monto_bs']=$documento->monto_bs;
        $items[0]['objeto']=$documento->objeto;
        $items[0]['modifica']=$documento->modifica;

        $items[0]['tipo_doc_nombre']=$documento->tipo_documento->nombre;
        $items[0]['contratante']=$documento->contratante->nombre;
        $items[0]['contratante_sigla']=$documento->contratante->sigla;
        $items[0]['contratado']=$documento->contratado->nombre;
        $items[0]['contratado_sigla']=$documento->contratado->sigla;

        $json=document::where('padre',$contrato_id )        
        ->where('document_types_id','!=','9')
        ->with('contratante')->with('contratado')
        ->with('tipo_documento')
        ->orderBy('fecha_firma')
        ->get();

        $obj = json_decode($json, true);

       for($i = 1; $i <= count( $obj); $i++) {
            $items[$i]['id']=$obj[$i-1]['id'];
            $items[$i]['nombre']=$obj[$i-1]['nombre'];
            $items[$i]['codigo']=$obj[$i-1]['codigo'];
            $items[$i]['fecha_firma']=$obj[$i-1]['fecha_firma'];
            $items[$i]['duracion_dias']=$obj[$i-1]['duracion_dias'];
            $items[$i]['monto_bs']=$obj[$i-1]['monto_bs'];
            $items[$i]['objeto']=$obj[$i-1]['objeto'];
            $items[$i]['modifica']=$obj[$i-1]['modifica'];

            $items[$i]['tipo_doc_nombre']=$obj[$i-1]['tipo_documento']['nombre'];

          
            $items[$i]['contratante']=$obj[$i-1]['contratante']['nombre']; 
            $items[$i]['contratante_sigla']=$obj[$i-1]['contratante']['sigla']; 
            $items[$i]['contratado']=$obj[$i-1]['contratado']['nombre']; 
            $items[$i]['contratado_sigla']=$obj[$i-1]['contratado']['sigla'];

           
        }




        return $items;


    }


}
