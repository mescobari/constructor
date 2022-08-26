<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\FrontEnd\cofinanciadores\TipoDocumento;
use App\Models\BackEnd\intervenciones\ClaInstitucional;
use App\Models\Constructor\OrdenesProceder;

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
    public function ordenProceder()
    {
        return $this->hasOne(OrdenesProceder::class, 'document_id', 'id');
    }


    public function getDocumento($id)
    {
        $documento = document::where('id',$id )
        ->with('contratante')->with('contratado')
        ->with('tipo_documento')
        ->with('ordenProceder')
        ->first();

        return $documento;
    }

    public function queModifica($modifica)
    {
        $que_modifica='';
        $modi=explode( ',', $modifica ) ;
        for($i = 0; $i < count( $modi); $i++) { 
                switch($modi[$i]) {
                    case 1:
                    $res='1.- Plazo';
                    break;
                    case 2:
                        $res='2.- Monto';
                    break;
                    case 3:
                        $res='3.- Items en Planilla';
                    break;
                }
                $que_modifica= $que_modifica.' '.$res;

            }

        return $que_modifica;
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
        $items[0]['que_modifica']=$this->queModifica($documento->modifica);
        $items[0]['tipo_doc_nombre']=$documento->tipo_documento->nombre;
        $items[0]['contratante']=$documento->contratante->nombre;
        $items[0]['contratante_sigla']=$documento->contratante->sigla;
        $items[0]['contratado']=$documento->contratado->nombre;
        $items[0]['contratado_sigla']=$documento->contratado->sigla;
        $items[0]['fecha_orden_proceder']=$documento->ordenProceder->fecha_orden_proceder;

        $json=document::where('padre',$contrato_id )        
        ->where('document_types_id','!=','9')
        ->where('document_types_id','!=','2')
        ->with('contratante')->with('contratado')
        ->with('tipo_documento')
        ->with('ordenProceder')
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
            $items[$i]['que_modifica']=$this->queModifica($obj[$i-1]['modifica']);
            $items[$i]['tipo_doc_nombre']=$obj[$i-1]['tipo_documento']['nombre'];

          
            $items[$i]['contratante']=$obj[$i-1]['contratante']['nombre']; 
            $items[$i]['contratante_sigla']=$obj[$i-1]['contratante']['sigla']; 
            $items[$i]['contratado']=$obj[$i-1]['contratado']['nombre']; 
            $items[$i]['contratado_sigla']=$obj[$i-1]['contratado']['sigla'];
            //$items[$i]['fecha_orden_proceder']=$obj[$i-1]['ordenProceder']['fecha_orden_proceder'];
           
        }




        return $items;


    }

    public function getSubContratos($contrato_id)
    {
        $items=[];
        
        $json=document::where('padre',$contrato_id )        
        ->where('document_types_id','=','2')
        ->with('contratante')->with('contratado')
        ->with('tipo_documento')
        ->with('ordenProceder')
        ->orderBy('fecha_firma')
        ->get();

        $obj = json_decode($json, true);

       for($i = 0; $i < count( $obj); $i++) {
            $items[$i]['id']=$obj[$i]['id'];
            $items[$i]['nombre']=$obj[$i]['nombre'];
            $items[$i]['codigo']=$obj[$i]['codigo'];
            $items[$i]['fecha_firma']=$obj[$i]['fecha_firma'];
            $items[$i]['duracion_dias']=$obj[$i]['duracion_dias'];
            $items[$i]['monto_bs']=$obj[$i]['monto_bs'];
            $items[$i]['objeto']=$obj[$i]['objeto'];
            $items[$i]['modifica']=$obj[$i]['modifica'];
            $items[$i]['que_modifica']=$this->queModifica($obj[$i]['modifica']);
            $items[$i]['tipo_doc_nombre']=$obj[$i]['tipo_documento']['nombre'];

          
            $items[$i]['contratante']=$obj[$i]['contratante']['nombre']; 
            $items[$i]['contratante_sigla']=$obj[$i]['contratante']['sigla']; 
            $items[$i]['contratado']=$obj[$i]['contratado']['nombre']; 
            $items[$i]['contratado_sigla']=$obj[$i]['contratado']['sigla'];
           // $items[$i]['fecha_orden_proceder']=$obj[$i-1]['ordenProceder']['fecha_orden_proceder'];
           
        }

        return $items;


    }


}
