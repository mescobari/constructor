<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\User;
use App\Models\FrontEnd\intervenciones\Intervencion;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\Localizacion;
use App\Models\FrontEnd\LocalizacionIntervencion;
use App\Models\FrontEnd\LocalizacionTipo;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;
use App\Models\FrontEnd\cofinanciadores\CofinanciadorDocumento;
use App\Models\FrontEnd\estructura_financiamiento\ComprobanteEncabezado;
use App\Models\FrontEnd\estructura_financiamiento\ComprobanteDetalle;

use App\Models\Constructor\Planilla;
use App\Models\Constructor\PlanillaMovimiento;
use App\Models\Constructor\PlanillaItem;
use App\Models\Constructor\document;
use App\Models\Constructor\PlanillaDocument;


use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PlanillaReportesController extends Controller
{
    public function inicio()
    {
        return view('front-end.reportes.IndexReportes');
    }
    public function Reportes_documentos_legales()
    {
        return view('front-end.reportes.IndexReportesDocumentosLegales');
    }
   

    public function lista_documentos(Request $request, $id){
        // todos los documentos relacionados con u  contrato
        $contrato_id=$id;
        $docs= new Document;
        $plani= new Planilla;

        $documento = $docs->getDocumento($contrato_id );

        $docs_modificatorios= $docs->getModificacion($contrato_id);

        $avance =$plani->getAvance($contrato_id);
        
        $docs_sub =$docs->getSubContratos($contrato_id);

        //datos para la cabecera del reportedel reporte
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = "Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil";
        $siglas = "EL CONSTRUCTOR";
        $documento_codigo = $documento->codigo;// codigo del contrato
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        //$nombre_reporte=  strtoupper($salida[0]['tipo_planilla_id']);
        $nombre_reporte=  'DOCUMENTOS RELACIONADOS';
        $documento_nombre= $documento->objeto;
        $documento_firma=date("d-m-Y", strtotime($documento->fecha_firma));
        $documento_monto= number_format($documento->monto_bs,2,",",".");

       
        /* cargamos la vista  */

        $pdf = PDF::loadView('front-end.reportes.constructor.documentos', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'documento_codigo' => $documento_codigo,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_reporte' => $nombre_reporte,
            'documento_nombre' => $documento_nombre,
            'documento_firma' => $documento_firma,
            'documento_monto' => $documento_monto,
            'docs_modificatorios' => $docs_modificatorios,
            'avance' => $avance,
            'docs_sub' => $docs_sub,

        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto.pdf');


          //  return $avance;

    }


/////**************************************************************************** */    
    public function plazos_documentos(Request $request, $id){
        $contrato_id=$id;
        $docs= new Document;
        $plani= new Planilla;

        $documento = $docs->getDocumento($contrato_id );
        $docs_modificatorios= $docs->getModificacion($contrato_id);
        //datos para la cabecera del reportedel reporte
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = "Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil";
        $siglas = "EL CONSTRUCTOR";
        $documento_codigo = $documento->codigo;// codigo del contrato
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        //$nombre_reporte=  strtoupper($salida[0]['tipo_planilla_id']);
        $nombre_reporte=  'VIGENCIA - PLAZOS FECHA ESTIMADA DE CONCLUSION';
        $documento_nombre= $documento->objeto;
        $documento_firma=date("d-m-Y", strtotime($documento->fecha_firma));
        $documento_monto= number_format($documento->monto_bs,2,",",".");


        /* cargamos la vista  */

        $pdf = PDF::loadView('front-end.reportes.constructor.vigencia', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'documento_codigo' => $documento_codigo,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_reporte' => $nombre_reporte,
            'documento_nombre' => $documento_nombre,
            'documento_firma' => $documento_firma,
            'documento_monto' => $documento_monto,
            'docs_modificatorios' => $docs_modificatorios,

        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto.pdf');


         //return $documento;



    }

/////******FIN *************plazos_documentos************************************************ */  

    public function planilla_individual(Request $request, $id){
        //$planilla = Planilla::where('id', $id)->first();
        $documento = DB::table('planilla_documents')
        ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
        ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
        ->select('documents.*', 'document_types.nombre' )
        ->where('planilla_documents.planilla_id', $id)
        ->first();

        $padre=$documento->padre;
        if ($padre != 0) {
            $documento_padre = DB::table('planilla_documents')
            ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
            ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
            ->select('documents.*', 'document_types.nombre')
            ->where('documents.id', $padre)
            ->first();

        } else  {
            $documento_padre = $documento;
        }

        $planilla = DB::table('planillas')
        ->leftjoin('planilla_movimientos', 'planillas.id', '=', 'planilla_movimientos.planilla_id')
        ->leftjoin('planilla_items', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->leftjoin('unidades', 'planilla_items.unidad_id', '=', 'unidades.id')
        ->select('planillas.*', 'planilla_movimientos.*', 'planilla_items.*','unidades.simbolo' )
        ->where('planillas.id', $id)
        ->get();

        $suma_grupos = DB::table('planilla_movimientos')
        ->leftjoin('planilla_items', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->select( 'planilla_items.padre',DB::raw('sum(planilla_movimientos.cantidad*planilla_movimientos.precio_unitario) as precio_total') )
        ->where('planilla_movimientos.planilla_id', $id)
        ->groupBy('planilla_items.padre')
        ->get();

//SELECT m.cantidad, m.precio_unitario, (m.cantidad* m.precio_unitario) as precio_total, i.padre FROM planilla_movimientos m, planilla_items i WHERE m.planilla_item_id=i.id and m.planilla_id = 1;

//SELECT m.cantidad, m.precio_unitario,
//sum(m.cantidad* m.precio_unitario) as precio_total, i.padre
//FROM planilla_movimientos m, planilla_items i
//WHERE m.planilla_item_id=i.id and m.planilla_id = 1 GROUP BY i.padre;

        $array1 = json_decode($planilla, true);
        $array2 = json_decode($suma_grupos, true);
        $keys = array_keys($array1);
        $salida=[];
        $super=[];
       
//xxxxxxxxxxxxxCalculamos subtotales de primer nivel o nivel superior rabajamos con array 2
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// debemos seleccionartodos 
for($i = 0; $i < count($array2); $i++) {
    $nivel=array_search(null, array_column($array2, 'precio_total'));
    if ($nivel!==false){
        $array2[$nivel]['precio_total']=12345;
        $super[]= $array2[$nivel]['padre'];
    }  
}
for($i = 1; $i < count($super); $i++) {
    $super_padre=$super[$i];
    $padres_grupos = DB::table('planilla_items')
        ->select('planilla_items.id' )
         ->where('planilla_items.padre', $super_padre)
        ->get();
        $super_suma=0;  
        $array3 = json_decode($padres_grupos, true);
        for($j = 0; $j < count($array3); $j++) {
            $item=$array3[$j]['id'];
            $indice=array_search($item, array_column($array2, 'padre'));
            $super_suma=$super_suma + $array2[$indice]['precio_total'];
          }
          $nivel=array_search($super_padre, array_column($array2, 'padre'));
         $array2[$nivel]['precio_total']=$super_suma;
}


//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

//procesamos la planlla poniendo los campos extras, cambiando formatos y calculando total item

        for($i = 0; $i < count($array1); $i++) {

            foreach($array1[$keys[$i]] as $key => $value) {
                $salida[$i][$key]=  $value ;
                if ($key =="tipo_planilla_id") {
                    if ($value==1) {
                        $newvalue='Planilla Inicial';
                      } elseif ($value==2) {
                        $newvalue='Planilla Modificatoria';
                      } else {
                        $newvalue='Planilla de Avance';;
                      }

                    $salida[$i][$key]= $newvalue;
                 }

                if ($key =="fecha_planilla") {

                    $salida[$i][$key]= date("d-m-Y", strtotime($value));
                 }

                if ($key =="total_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }
                 if ($key =="anticipo_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }
                 if ($key =="retencion_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }


            }
            // aqui los campos calculados y actualizacion
            $salida[$i]['precio_total']=number_format($salida[$i]['cantidad']*$salida[$i]['precio_unitario'],2,",",".");
            $salida[$i]['cantidad']= number_format( $salida[$i]['cantidad'],2,",",".");
            $salida[$i]['precio_unitario']= number_format( $salida[$i]['precio_unitario'],2,",",".");

        }

// calculamos los totales de la planilla

        $grupos = array();
        for($i = 0; $i < count($array1); $i++) {

            foreach($array1[$keys[$i]] as $key => $value) {

                if ($key =="tipo") {
                    if ($value =="G") {
                        $grupos[] =  $array1[$i]['id'];
                        $id =  $array1[$i]['id'];

                        //$buscar= array_search($id,$array2);
                        $found_key = array_search($id, array_column($array2, 'padre'));
                        if ($found_key != false) {
                            $salida[$i]['precio_total']=
                            number_format($array2[$found_key]['precio_total'],2,",",".");

                        }


                    }
                }
            }
         }

//datos para la cabecera del reportedel reporte
$titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
$nombre_institucion = "Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil";
$siglas = "EL CONSTRUCTOR";
$documento_codigo = $documento->codigo;// codigo del contrato
$fecha_hora_emision = date('d-m-Y h:i:s a', time());
$nombre_reporte=  strtoupper($salida[0]['tipo_planilla_id']);

$documento_nombre= $documento->objeto;
$documento_firma=date("d-m-Y", strtotime($documento->fecha_firma));
$documento_monto= number_format($documento->monto_bs,2,",",".");

$fecha_planilla= $salida[0]['fecha_planilla'];
$nuri_planilla= $salida[0]['nuri_planilla'];
$referencia= $salida[0]['referencia'];
$total_planilla=  $salida[0]['total_planilla'];
$anticipo_planilla=  $salida[0]['anticipo_planilla'];
$retencion_planilla=  $salida[0]['retencion_planilla'];

$principal_codigo=$documento_padre->codigo;
$principal_nombre=$documento_padre->objeto;
$principal_firma=date("d-m-Y", strtotime($documento_padre->fecha_firma));
$principal_monto= number_format($documento_padre->monto_bs,2,",",".");

// otros datos para el cuerpo


 /* cargamos la vista  */

        $pdf = PDF::loadView('front-end.reportes.constructor.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'documento_codigo' => $documento_codigo,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_reporte' => $nombre_reporte,
            'documento_nombre' => $documento_nombre,
            'documento_firma' => $documento_firma,
            'documento_monto' => $documento_monto,
            'fecha_planilla' => $fecha_planilla,
            'nuri_planilla' => $nuri_planilla,
            'referencia' => $referencia,
            'total_planilla' => $total_planilla,
            'anticipo_planilla' => $anticipo_planilla,
            'retencion_planilla' => $retencion_planilla,
            'principal_codigo' => $principal_codigo,
            'principal_nombre' => $principal_nombre,
            'principal_firma' =>  $principal_firma,
            'principal_monto' =>  $principal_monto,
            'padre' =>  $padre,
            'planilla' =>  $salida,



        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto.pdf');

 
     // return  $array3;
    }


////********************************************************************************** */
    public function planilla_vigente(Request $request, $id){
////********************************************************************************** */

        $contrato_id=$id;
        $plaI= new PlanillaItem;
        $docs= new Document;
        $movs= new PlanillaMovimiento;

        $documento = $docs->getDocumento($contrato_id );


        // aqui tengo $items=planilla_items

        $items=$plaI->getEstructuraItems($contrato_id);

        // analizar cuantas planillas de cambio hubo tipo_planilla
         // cargamos la planilla-cuadro
       for($i = 0; $i < count( $items); $i++) { 

        $items[$i]['inic_cant']= 0;
        $items[$i]['inic_pu']=0;
        $items[$i]['inic_pt']= 0;

        $items[$i]['vig_cant']= 0;
        $items[$i]['vig_pu']= 0;
        $items[$i]['vig_pt']= 0;

        $items[$i]['diff_cant']= 0;
        $items[$i]['diff_pu']= 0;
        $items[$i]['diff_pt']=0; 

    }

        $docs_modificatorios= $docs->getModificacion($contrato_id);
        

            //inicial    
        $inic_doc=$docs_modificatorios[0]['id'];
        $busPla = DB::table('planilla_documents')->where('document_id', $inic_doc) ->first();
        $inicial_id=$busPla->planilla_id;
        $inicial=$movs->getPlanilla($inicial_id);
        
        for($i = 0; $i < count( $items); $i++) { 
            $linea=$items[$i]['id'];
            $key = array_search( $linea, array_column($inicial, 'planilla_item_id'));
            if ($key!=false){

                $items[$i]['inic_cant']= $inicial[$key]['cantidad'] ;
                $items[$i]['inic_pu']= $inicial[$key]['precio_unitario'] ;
                $items[$i]['inic_pt']= ($inicial[$key]['cantidad']*$inicial[$key]['precio_unitario']) ;
                

            } else { 
                $items[$i]['inic_cant']=1;
                $items[$i]['inic_cant']=1;
                $items[$i]['inic_cant']=1;
            } 


         }


        // obtenemos la planilla vigente
        $vig_doc=$docs_modificatorios[count($docs_modificatorios)-1]['id'];
        $busPla = DB::table('planilla_documents')->where('document_id', $vig_doc) ->first();
        $vigente_id=$busPla->planilla_id;
       $vigente=$movs->getPlanilla($vigente_id);      

         //vigente
         for($i = 0; $i < count( $items); $i++) { 
            $linea=$items[$i]['id'];
            $key = array_search( $linea, array_column($vigente, 'planilla_item_id'));
            if ($key!=false){

                $items[$i]['vig_cant']= $vigente[$key]['cantidad'] ;
                $items[$i]['vig_pu']= $vigente[$key]['precio_unitario'] ;
                $items[$i]['vig_pt']= ($vigente[$key]['cantidad']*$vigente[$key]['precio_unitario']) ;
                

            } else { 
                $items[$i]['vig_cant']=1;
                $items[$i]['vig_pu']=1;
                $items[$i]['vig_pt']=1;
            } 


         }



       //diferencia

       for($i = 0; $i < count( $items); $i++) { 
       
        $items[$i]['diff_cant']=   $items[$i]['vig_cant'] -$items[$i]['inic_cant'];
        $items[$i]['diff_pu']=    $items[$i]['inic_pu']; ;
        $items[$i]['diff_pt']= $items[$i]['vig_pt'] -$items[$i]['inic_pt'];

        
     }


     //calculamos subtotales
     // necesitamos el array de patriarcas
        $json = DB::table('planilla_items')->where('contrato_id', $contrato_id)
        ->where('padre', '0')
        ->get();    
        $patriarca = json_decode($json, true);

        //sumamos items 
        for($i = 0; $i < count( $items); $i++) { 
            $tipo=$items[$i]['tipo'];
            

            if ($tipo =="G") { 
                $padre=$items[$i]['id']; 
                $inic_total=0;   $vig_total=0;    $diff_total=0;                 
                // sumamos todos los itemes que tiene padre=$padre
                for($j = 0; $j < count( $items); $j++) {
                    $padreI=$items[$j]['padre'];
                    if ($padreI ==$padre) {
                        $tipoI=$items[$j]['tipo'];
                        if ($tipoI =="I") {
                            $inic_total=$inic_total+$items[$j]['inic_pt'];
                            $vig_total=$vig_total+$items[$j]['vig_pt'];
                            $diff_total=$diff_total+$items[$j]['diff_pt'];
                        }
                    }

                }
                // registramos la sumayo 
                $items[$i]['inic_pt']=$inic_total;
                $items[$i]['vig_pt']=$vig_total;
                $items[$i]['diff_pt']=$diff_total;

             }
           
        }   

        // ahora sumamos los grupos

        for($i = 0; $i < count( $items); $i++) { 
            $tipo=$items[$i]['tipo'];
            

            if ($tipo =="G") { 
                $padre=$items[$i]['id']; 
                $inic_total=0;   $vig_total=0;    $diff_total=0;                 
                // sumamos todos los itemes que tiene padre=$padre
                for($j = 0; $j < count( $items); $j++) {
                    $padreI=$items[$j]['padre'];
                    if ($padreI ==$padre) {
                        $tipoI=$items[$j]['tipo'];
                        if ($tipoI =="G") {
                            $inic_total=$inic_total+$items[$j]['inic_pt'];
                            $vig_total=$vig_total+$items[$j]['vig_pt'];
                            $diff_total=$diff_total+$items[$j]['diff_pt'];
                        }
                    }

                }
                // registramos la sumayo 
                $items[$i]['inic_pt']=$inic_total+ $items[$i]['inic_pt'];
                $items[$i]['vig_pt']=$vig_total+ $items[$i]['vig_pt'];
                $items[$i]['diff_pt']=$diff_total+ $items[$i]['diff_pt'];

             }
           
        }   
        
        // obtenemos el tota total
        $inic_total=0;   $vig_total=0;    $diff_total=0; 

        for($i = 0; $i < count( $items); $i++) { 
            $tipo=$items[$i]['tipo'];
            if ($tipoI =="I") {
                $inic_total=$inic_total+$items[$i]['inic_pt'];
                $vig_total=$vig_total+$items[$i]['vig_pt'];
                $diff_total=$diff_total+$items[$i]['diff_pt'];
            }

        }
        $inic_total= number_format( $inic_total,2,",",".");
        $vig_total= number_format( $vig_total,2,",",".");
        $diff_total= number_format( $diff_total,2,",",".");

      // una vez calculado ponemos en formato

     for($i = 0; $i < count( $items); $i++) { 

       
        $items[$i]['inic_cant']= number_format( $items[$i]['inic_cant'],2,",",".");
        $items[$i]['inic_pu']= number_format( $items[$i]['inic_pu'],2,",",".");
        $items[$i]['inic_pt']= number_format( $items[$i]['inic_pt'],2,",",".");

        $items[$i]['vig_cant']= number_format( $items[$i]['vig_cant'],2,",",".");
        $items[$i]['vig_pu']= number_format( $items[$i]['vig_pu'],2,",",".");
        $items[$i]['vig_pt']= number_format( $items[$i]['vig_pt'],2,",",".");

        $items[$i]['diff_cant']= number_format( $items[$i]['diff_cant'],2,",",".");
        $items[$i]['diff_pu']= number_format( $items[$i]['diff_pu'],2,",",".");
        $items[$i]['diff_pt']= number_format( $items[$i]['diff_pt'],2,",",".");


     }


        
     


         //datos para la cabecera del reportedel reporte
$titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
$nombre_institucion = "Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil";
$siglas = "EL CONSTRUCTOR";
$documento_codigo = $documento->codigo;// codigo del contrato
$fecha_hora_emision = date('d-m-Y h:i:s a', time());
//$nombre_reporte=  strtoupper($salida[0]['tipo_planilla_id']);
$nombre_reporte='ÇALCULO DEL VALOR VIGENTE';
$documento_nombre= $documento->objeto;
$documento_firma=date("d-m-Y", strtotime($documento->fecha_firma));
$documento_monto= number_format($documento->monto_bs,2,",",".");


$principal_codigo=$docs_modificatorios[0]['codigo'];
$principal_nombre=$docs_modificatorios[0]['nombre'];
 $principal_firma=date("d-m-Y", strtotime($docs_modificatorios[0]['fecha_firma']));
 $principal_monto= number_format($docs_modificatorios[0]['monto_bs'],2,",",".");


// otros datos para el cuerpo


 /* cargamos la vista  */

        $pdf = PDF::loadView('front-end.reportes.constructor.vigente', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'documento_codigo' => $documento_codigo,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_reporte' => $nombre_reporte,
            'documento_nombre' => $documento_nombre,
            'documento_firma' => $documento_firma,
            'documento_monto' => $documento_monto,
            'principal_codigo' => $principal_codigo,
            'principal_nombre' => $principal_nombre,
            'principal_firma' =>  $principal_firma,
            'principal_monto' =>  $principal_monto,
            'planilla' =>  $items,



        ]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('reporte_ficha_proyecto.pdf');


     //return  $items;
    }

//********************************************************************************************************************** */
    public function planilla_ejecucion(Request $request, $id){
//********************************************************************************************************************** */

        $contrato_id=$id;
        $plaI= new PlanillaItem;
        $docs= new Document;
        $movs= new PlanillaMovimiento;
        $plani= new Planilla;

        $documento = $docs->getDocumento($contrato_id );

        $avance =$plani->getAvance($contrato_id);

        // sumamos el avance
        $total=0; $anticipo=0; $retencion=0;
        for($i = 0; $i < count( $avance); $i++) {
            $total= $total+ $avance[$i]['total_planilla'];
            $anticipo= $anticipo+ $avance[$i]['anticipo_planilla'];
            $retencion= $retencion+ $avance[$i]['retencion_planilla'];
            $avance[$i]['total_planilla']= number_format(  $avance[$i]['total_planilla'],2,",",".");
            $avance[$i]['anticipo_planilla']= number_format(  $avance[$i]['anticipo_planilla'],2,",",".");
            $avance[$i]['retencion_planilla']= number_format(  $avance[$i]['retencion_planilla'],2,",",".");

        }  
        $avance[$i]['nombre']='Total avance finaaciero segun planillas';
        $avance[$i]['referencia']='';
        $avance[$i]['fecha_planilla']=date('d-m-Y h:i:s a', time());;
        $avance[$i]['nuri_planilla']='-';
        $avance[$i]['numero_planilla']='-';
        $avance[$i]['total_planilla']= number_format( $total,2,",",".");
        $avance[$i]['anticipo_planilla']= number_format( $anticipo,2,",",".");
        $avance[$i]['retencion_planilla']= number_format( $retencion,2,",",".");


        // aqui tengo $items=planilla_items, la estructura

        $items=$plaI->getEstructuraItems($contrato_id);

        // analizar cuantas planillas de cambio hubo tipo_planilla
         // cargamos la planilla-cuadro
       for($i = 0; $i < count( $items); $i++) { 

        $items[$i]['vig_cant']= 0;
        $items[$i]['vig_pu']= 0;
        $items[$i]['vig_pt']= 0;

        $items[$i]['acum_cant']= 0;
        $items[$i]['acum_pu']=0;
        $items[$i]['acum_pt']= 0;

        $items[$i]['diff_cant']= 0;
        $items[$i]['diff_pu']= 0;
        $items[$i]['diff_pt']=0;
        $items[$i]['porcentaje']=0;

    }

// ya tenemos la estructura d ela planilla
// ahora traer las planillas que seran desplegadas
 // obtenemos la planilla vigente

 $docs_modificatorios= $docs->getModificacion($contrato_id);

 $vig_doc=$docs_modificatorios[count($docs_modificatorios)-1]['id'];

 $busPla = DB::table('planilla_documents')->where('document_id', $vig_doc) ->first();
 $vigente_id=$busPla->planilla_id;
 $vigente=$movs->getPlanilla($vigente_id);      

  //vigente
  for($i = 0; $i < count( $items); $i++) { 
     $linea=$items[$i]['id'];
     $key = array_search( $linea, array_column($vigente, 'planilla_item_id'));
     if ($key!=false){

         $items[$i]['vig_cant']= $vigente[$key]['cantidad'] ;
         $items[$i]['vig_pu']= $vigente[$key]['precio_unitario'] ;
         $items[$i]['vig_pt']= ($vigente[$key]['cantidad']*$vigente[$key]['precio_unitario']) ;
         

     } else { 
         $items[$i]['vig_cant']=1;
         $items[$i]['vig_pu']=1;
         $items[$i]['vig_pt']=1;
     } 


  }

  // acumulado suma de planillas

  $docs_avance= $plani->getAvance($contrato_id);
  $avance_acumulado=$plani->getAvanceAcumulado($contrato_id); 

//acumulado
  for($i = 0; $i < count( $items); $i++) { 
     $linea=$items[$i]['id'];
     $key = array_search( $linea, array_column($avance_acumulado, 'planilla_item_id'));
     if ($key!=false){

         $items[$i]['acum_cant']= $avance_acumulado[$key]['cantidad'] ;
         $items[$i]['acum_pu']= $avance_acumulado[$key]['precio_unitario'] ;
         $items[$i]['acum_pt']= ($avance_acumulado[$key]['cantidad']*$avance_acumulado[$key]['precio_unitario']) ;
         

     } else { 
         $items[$i]['acum_cant']=0;
         $items[$i]['acum_pu']=0;
         $items[$i]['acum_pt']=0;
     } 


  }


//diferencia

       for($i = 0; $i < count( $items); $i++) { 
       
        $items[$i]['diff_cant']=   $items[$i]['vig_cant'] -$items[$i]['acum_cant'];
        $items[$i]['diff_pu']=    $items[$i]['vig_pu']; ;
        $items[$i]['diff_pt']= $items[$i]['vig_pt'] -$items[$i]['acum_pt'];
        if ($items[$i]['vig_cant'] !=0) { 
            $items[$i]['porcentaje']=($items[$i]['acum_cant']/$items[$i]['vig_cant'])*100;
            $items[$i]['porcentaje']= number_format($items[$i]['porcentaje'],0,",",".");
        }
     }

//********************************************************************************************* */
  //calculamos subtotales
     
     //sumamos items 
     for($i = 0; $i < count( $items); $i++) { 
         $tipo=$items[$i]['tipo'];
         

         if ($tipo =="G") { 
             $padre=$items[$i]['id']; 
             $vig_total=0;   $acum_total=0;    $diff_total=0;                 
             // sumamos todos los itemes que tiene padre=$padre
             for($j = 0; $j < count( $items); $j++) {
                 $padreI=$items[$j]['padre'];
                 if ($padreI ==$padre) {
                     $tipoI=$items[$j]['tipo'];
                     if ($tipoI =="I") {
                         $vig_total=$vig_total+$items[$j]['vig_pt'];
                         $acum_total=$acum_total+$items[$j]['acum_pt'];
                         $diff_total=$diff_total+$items[$j]['diff_pt'];
                     }
                 }

             }
             // registramos la sumayo 
             $items[$i]['vig_pt']=$vig_total;
             $items[$i]['acum_pt']=$acum_total;
             $items[$i]['diff_pt']=$diff_total;

          }
        
     }   

     // ahora sumamos los grupos

     for($i = 0; $i < count( $items); $i++) { 
         $tipo=$items[$i]['tipo'];
         

         if ($tipo =="G") { 
             $padre=$items[$i]['id']; 
             $vig_total=0;   $acum_total=0;    $diff_total=0;                 
             // sumamos todos los itemes que tiene padre=$padre
             for($j = 0; $j < count( $items); $j++) {
                 $padreI=$items[$j]['padre'];
                 if ($padreI ==$padre) {
                     $tipoI=$items[$j]['tipo'];
                     if ($tipoI =="G") {
                         $vig_total=$vig_total+$items[$j]['vig_pt'];
                         $acum_total=$acum_total+$items[$j]['acum_pt'];
                         $diff_total=$diff_total+$items[$j]['diff_pt'];
                     }
                 }

             }
             // registramos la sumayo 
             $items[$i]['vig_pt']=$vig_total+ $items[$i]['vig_pt'];
             $items[$i]['acum_pt']=$acum_total+ $items[$i]['acum_pt'];
             $items[$i]['diff_pt']=$diff_total+ $items[$i]['diff_pt'];

          }
        
     }   
     
     // obtenemos el tota total
     $vig_total=0;   $acum_total=0;    $diff_total=0; 

     for($i = 0; $i < count( $items); $i++) { 
         $tipo=$items[$i]['tipo'];
         if ($tipoI =="I") {
             $vig_total=$vig_total+$items[$i]['vig_pt'];
             $acum_total=$acum_total+$items[$i]['acum_pt'];
             $diff_total=$diff_total+$items[$i]['diff_pt'];
         }

     }
     $vig_total= number_format( $vig_total,2,",",".");
     $acum_total= number_format( $acum_total,2,",",".");
     $diff_total= number_format( $diff_total,2,",",".");

   // una vez calculado ponemos en formato

  for($i = 0; $i < count( $items); $i++) { 

    
    
     $items[$i]['vig_cant']= number_format( $items[$i]['vig_cant'],2,",",".");
     $items[$i]['vig_pu']= number_format( $items[$i]['vig_pu'],2,",",".");
     $items[$i]['vig_pt']= number_format( $items[$i]['vig_pt'],2,",",".");

     $items[$i]['acum_cant']= number_format( $items[$i]['acum_cant'],2,",",".");
     $items[$i]['acum_pu']= number_format( $items[$i]['acum_pu'],2,",",".");
     $items[$i]['acum_pt']= number_format( $items[$i]['acum_pt'],2,",",".");


     $items[$i]['diff_cant']= number_format( $items[$i]['diff_cant'],2,",",".");
     $items[$i]['diff_pu']= number_format( $items[$i]['diff_pu'],2,",",".");
     $items[$i]['diff_pt']= number_format( $items[$i]['diff_pt'],2,",",".");


  }


     
 //********************************************************************************************* */ 
//********************************************************************************************* */





        //$planilla = Planilla::where('id', $id)->first();
        $documento = DB::table('planilla_documents')
        ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
        ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
        ->select('documents.*', 'document_types.nombre as tipo_nombre' )
        ->where('planilla_documents.planilla_id', $id)
        ->first();

        $padre=$documento->padre;
        if ($padre != 0) {
            $documento_padre = DB::table('planilla_documents')
            ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
            ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
            ->select('documents.*', 'document_types.nombre')
            ->where('documents.id', $padre)
            ->first();

        } else  {
            $documento_padre = $documento;
        }

        $planilla = DB::table('planillas')
        ->leftjoin('planilla_movimientos', 'planillas.id', '=', 'planilla_movimientos.planilla_id')
        ->leftjoin('planilla_items', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->leftjoin('unidades', 'planilla_items.unidad_id', '=', 'unidades.id')
        ->select('planillas.*', 'planilla_movimientos.*', 'planilla_items.*','unidades.simbolo' )
        ->where('planillas.id', $id)
        ->get();

        $suma_grupos = DB::table('planilla_movimientos')
        ->leftjoin('planilla_items', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->select( 'planilla_items.padre',DB::raw('sum(planilla_movimientos.cantidad*planilla_movimientos.precio_unitario) as precio_total') )
        ->where('planilla_movimientos.planilla_id', $id)
        ->groupBy('planilla_items.padre')
        ->get();



        $array1 = json_decode($planilla, true);
        $array2 = json_decode($suma_grupos, true);


        $keys = array_keys($array1);
        $salida=[];




//procesamos la planlla poniendo los campos extras, cambiando formatos y calculando total item

        for($i = 0; $i < count($array1); $i++) {

            foreach($array1[$keys[$i]] as $key => $value) {
                $salida[$i][$key]=  $value ;
                if ($key =="tipo_planilla_id") {
                    if ($value==1) {
                        $newvalue='Planilla Inicial';
                      } elseif ($value==2) {
                        $newvalue='Planilla Modificatoria';
                      } else {
                        $newvalue='Planilla de Avance';;
                      }

                    $salida[$i][$key]= $newvalue;
                 }

                if ($key =="fecha_planilla") {

                    $salida[$i][$key]= date("d-m-Y", strtotime($value));
                 }

                if ($key =="total_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }
                 if ($key =="anticipo_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }
                 if ($key =="retencion_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }


            }
            // aqui los campos calculados y actualizacion
            $salida[$i]['precio_total']=number_format($salida[$i]['cantidad']*$salida[$i]['precio_unitario'],2,",",".");
            $salida[$i]['cantidad']= number_format( $salida[$i]['cantidad'],2,",",".");
            $salida[$i]['precio_unitario']= number_format( $salida[$i]['precio_unitario'],2,",",".");

        }

// calculamos los totales de la planilla

        $grupos = array();
        for($i = 0; $i < count($array1); $i++) {

            foreach($array1[$keys[$i]] as $key => $value) {

                if ($key =="tipo") {
                    if ($value =="G") {
                        $grupos[] =  $array1[$i]['id'];
                        $id =  $array1[$i]['id'];

                        //$buscar= array_search($id,$array2);
                        $found_key = array_search($id, array_column($array2, 'padre'));
                        if ($found_key != false) {
                            $salida[$i]['precio_total']=
                            number_format($array2[$found_key]['precio_total'],2,",",".");

                        }


                    }
                }
            }
         }

//datos para la cabecera del reportedel reporte
$titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
$nombre_institucion = "Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil";
$siglas = "EL CONSTRUCTOR";
$documento_codigo = $documento->codigo;// codigo del contrato
$fecha_hora_emision = date('d-m-Y h:i:s a', time());
//$nombre_reporte=  strtoupper($salida[0]['tipo_planilla_id']);
$nombre_reporte='calculo avance acumulado y saldos';
$documento_nombre= $documento->objeto;
$documento_firma=date("d-m-Y", strtotime($documento->fecha_firma));
$documento_monto= number_format($documento->monto_bs,2,",",".");

$fecha_planilla= $salida[0]['fecha_planilla'];
$nuri_planilla= $salida[0]['nuri_planilla'];
$referencia= $salida[0]['referencia'];
$total_planilla=  $salida[0]['total_planilla'];
$anticipo_planilla=  $salida[0]['anticipo_planilla'];
$retencion_planilla=  $salida[0]['retencion_planilla'];

$principal_codigo=$documento_padre->codigo;
$principal_nombre=$documento_padre->objeto;
$principal_firma=date("d-m-Y", strtotime($documento_padre->fecha_firma));
$principal_monto= number_format($documento_padre->monto_bs,2,",",".");

// otros datos para el cuerpo


 /* cargamos la vista   */

        $pdf = PDF::loadView('front-end.reportes.constructor.avance', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'documento_codigo' => $documento_codigo,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_reporte' => $nombre_reporte,
            'documento_nombre' => $documento_nombre,
            'documento_firma' => $documento_firma,
            'documento_monto' => $documento_monto,
            'fecha_planilla' => $fecha_planilla,
            'nuri_planilla' => $nuri_planilla,
            'referencia' => $referencia,
            'total_planilla' => $total_planilla,
            'anticipo_planilla' => $anticipo_planilla,
            'retencion_planilla' => $retencion_planilla,
            'principal_codigo' => $principal_codigo,
            'principal_nombre' => $principal_nombre,
            'principal_firma' =>  $principal_firma,
            'principal_monto' =>  $principal_monto,
            'padre' =>  $padre,
            'planilla' =>  $items,
             'certificados' =>  $avance,



        ]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('reporte_ficha_proyecto.pdf');


      //return  $avance;
    }


///************************************************************************************ */
    public function graficos_ejecucion(Request $request, $id){
///************************************************************************************ */
        //$planilla = Planilla::where('id', $id)->first();
        $documento = DB::table('planilla_documents')
        ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
        ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
        ->select('documents.*', 'document_types.nombre' )
        ->where('planilla_documents.planilla_id', $id)
        ->first();

        $padre=$documento->padre;
        if ($padre != 0) {
            $documento_padre = DB::table('planilla_documents')
            ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
            ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
            ->select('documents.*', 'document_types.nombre')
            ->where('documents.id', $padre)
            ->first();

        } else  {
            $documento_padre = $documento;
        }

        $planilla = DB::table('planillas')
        ->leftjoin('planilla_movimientos', 'planillas.id', '=', 'planilla_movimientos.planilla_id')
        ->leftjoin('planilla_items', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->leftjoin('unidades', 'planilla_items.unidad_id', '=', 'unidades.id')
        ->select('planillas.*', 'planilla_movimientos.*', 'planilla_items.*','unidades.simbolo' )
        ->where('planillas.id', $id)
        ->get();

        $suma_grupos = DB::table('planilla_movimientos')
        ->leftjoin('planilla_items', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->select( 'planilla_items.padre',DB::raw('sum(planilla_movimientos.cantidad*planilla_movimientos.precio_unitario) as precio_total') )
        ->where('planilla_movimientos.planilla_id', $id)
        ->groupBy('planilla_items.padre')
        ->get();



        $array1 = json_decode($planilla, true);
        $array2 = json_decode($suma_grupos, true);


        $keys = array_keys($array1);
        $salida=[];




//procesamos la planlla poniendo los campos extras, cambiando formatos y calculando total item

        for($i = 0; $i < count($array1); $i++) {

            foreach($array1[$keys[$i]] as $key => $value) {
                $salida[$i][$key]=  $value ;
                if ($key =="tipo_planilla_id") {
                    if ($value==1) {
                        $newvalue='Planilla Inicial';
                      } elseif ($value==2) {
                        $newvalue='Planilla Modificatoria';
                      } else {
                        $newvalue='Planilla de Avance';;
                      }

                    $salida[$i][$key]= $newvalue;
                 }

                if ($key =="fecha_planilla") {

                    $salida[$i][$key]= date("d-m-Y", strtotime($value));
                 }

                if ($key =="total_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }
                 if ($key =="anticipo_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }
                 if ($key =="retencion_planilla") {
                    $salida[$i][$key]= number_format($value,2,",",".");
                 }


            }
            // aqui los campos calculados y actualizacion
            $salida[$i]['precio_total']=number_format($salida[$i]['cantidad']*$salida[$i]['precio_unitario'],2,",",".");
            $salida[$i]['cantidad']= number_format( $salida[$i]['cantidad'],2,",",".");
            $salida[$i]['precio_unitario']= number_format( $salida[$i]['precio_unitario'],2,",",".");

        }

// calculamos los totales de la planilla

        $grupos = array();
        for($i = 0; $i < count($array1); $i++) {

            foreach($array1[$keys[$i]] as $key => $value) {

                if ($key =="tipo") {
                    if ($value =="G") {
                        $grupos[] =  $array1[$i]['id'];
                        $id =  $array1[$i]['id'];

                        //$buscar= array_search($id,$array2);
                        $found_key = array_search($id, array_column($array2, 'padre'));
                        if ($found_key != false) {
                            $salida[$i]['precio_total']=
                            number_format($array2[$found_key]['precio_total'],2,",",".");

                        }


                    }
                }
            }
         }

//datos para la cabecera del reportedel reporte
$titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
$nombre_institucion = "Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil";
$siglas = "EL CONSTRUCTOR";
$documento_codigo = $documento->codigo;// codigo del contrato
$fecha_hora_emision = date('d-m-Y h:i:s a', time());
//$nombre_reporte=  strtoupper($salida[0]['tipo_planilla_id']);
$nombre_reporte='ÇALCULO DEL VALOR VIGENTE';
$documento_nombre= $documento->objeto;
$documento_firma=date("d-m-Y", strtotime($documento->fecha_firma));
$documento_monto= number_format($documento->monto_bs,2,",",".");

$fecha_planilla= $salida[0]['fecha_planilla'];
$nuri_planilla= $salida[0]['nuri_planilla'];
$referencia= $salida[0]['referencia'];
$total_planilla=  $salida[0]['total_planilla'];
$anticipo_planilla=  $salida[0]['anticipo_planilla'];
$retencion_planilla=  $salida[0]['retencion_planilla'];

$principal_codigo=$documento_padre->codigo;
$principal_nombre=$documento_padre->objeto;
$principal_firma=date("d-m-Y", strtotime($documento_padre->fecha_firma));
$principal_monto= number_format($documento_padre->monto_bs,2,",",".");

// otros datos para el cuerpo


 /* cargamos la vista   */

        $pdf = PDF::loadView('front-end.reportes.constructor.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'documento_codigo' => $documento_codigo,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_reporte' => $nombre_reporte,
            'documento_nombre' => $documento_nombre,
            'documento_firma' => $documento_firma,
            'documento_monto' => $documento_monto,
            'fecha_planilla' => $fecha_planilla,
            'nuri_planilla' => $nuri_planilla,
            'referencia' => $referencia,
            'total_planilla' => $total_planilla,
            'anticipo_planilla' => $anticipo_planilla,
            'retencion_planilla' => $retencion_planilla,
            'principal_codigo' => $principal_codigo,
            'principal_nombre' => $principal_nombre,
            'principal_firma' =>  $principal_firma,
            'principal_monto' =>  $principal_monto,
            'padre' =>  $padre,
            'planilla' =>  $salida,



        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto.pdf');


      //return  json_encode($salida);
    }






//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

 
 

}
