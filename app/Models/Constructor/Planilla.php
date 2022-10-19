<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Planilla extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_planilla_id', 'fecha_planilla', 'contrato_id','numero_planilla', 'nuri_planilla',
     'referencia', 'path_planilla', 'total_planilla','anticipo_planilla', 'retencion_planilla', 'estado_planilla' ];

	protected $table = 'planillas';


    public function getAvance($contrato_id)
    {
        $items=[];
       // SELECT m.*, p.* FROM planillas p, planilla_movimientos m where p.id=m.planilla_id and  p.contrato_id=2 and p.tipo_planilla_id=3      
        
        $planilla_documentos = DB::table('planilla_documents')
        ->join('documents', 'planilla_documents.document_id', '=', 'documents.id')
        ->join('document_types', 'documents.document_types_id', '=', 'document_types.id')
        ->join('planillas', 'planilla_documents.planilla_id', '=', 'planillas.id')
        ->select('planillas.*', 'document_types.nombre',  'documents.*')
        ->where('planillas.contrato_id', $contrato_id)
        ->where('planillas.tipo_planilla_id', '3')
        ->orderBy('planillas.fecha_planilla')
        ->get();

       
       
        $obj = json_decode($planilla_documentos, true);

      
        for($i = 0; $i < count( $obj); $i++) {
            $items[$i]['id']=$obj[$i]['id'];
            $items[$i]['nombre']=$obj[$i]['nombre'];
            $items[$i]['codigo']=$obj[$i]['codigo'];
            $items[$i]['fecha_firma']=date("d-m-Y", strtotime($obj[$i]['fecha_firma']));
            $items[$i]['duracion_dias']=$obj[$i]['duracion_dias'];
            $items[$i]['monto_bs']=$obj[$i]['monto_bs'];
            $items[$i]['objeto']=$obj[$i]['objeto'];
            $items[$i]['modifica']=$obj[$i]['modifica'];


            $items[$i]['tipo_planilla_id']=$obj[$i]['tipo_planilla_id'];
            $items[$i]['fecha_planilla']=date("d-m-Y", strtotime($obj[$i]['fecha_planilla']));          
            $items[$i]['numero_planilla']=$obj[$i]['numero_planilla'];
            $items[$i]['nuri_planilla']=$obj[$i]['nuri_planilla'];
            $items[$i]['referencia']=$obj[$i]['referencia'];

            $items[$i]['total_planilla']=$obj[$i]['total_planilla'];
            $items[$i]['anticipo_planilla']=$obj[$i]['anticipo_planilla'];
            $items[$i]['retencion_planilla']=$obj[$i]['retencion_planilla'];



           
        }



        return $items;


    }

    public function getAvanceAcumulado($contrato_id)
    {
        //recibimos contrato ya que ya sabemos tip de planilla
/*
        SELECT m.planilla_item_id, sum(m.cantidad) as cantidad, m.precio_unitario  FROM planilla_movimientos m, planillas p 
        WHERE p.id=m.planilla_id and p.contrato_id = 2 and p.tipo_planilla_id=3 group by m.planilla_item_id;

        $avance = DB::table('planillas')
        ->join('planilla_movimientos', 'planilla_movimientos.planilla_id', '=', 'planillas.id')
        ->select('planilla_movimientos.*')
        ->where('planillas.contrato_id', $contrato_id)
        ->where('planillas.tipo_planilla_id', '3')
        ->orderBy('planillas.fecha_planilla')
        ->get();

           Document::Where('some_condition',true)
        ->selectRaw("SUM(debit) as total_debit")
        ->selectRaw("SUM(credit) as total_credit")
        ->groupBy('id')
        ->get();

        $users = User::join('posts', 'posts.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->where('posts.status','active')
            ->get(['users.*', 'posts.descrption']);

    ->selectRaw('SUM(planilla_movimientos.cantidad) as cantidad')
    
    ->select('planilla_movimientos.planilla_item_id',  DB::raw('SUM(planilla_movimientos.cantidad) as cantidad'),
    'planilla_movimientos.precio_unitario')
*/

    $avance = Planilla::join('planilla_movimientos', 'planilla_movimientos.planilla_id', '=', 'planillas.id')
    ->where('planillas.contrato_id', $contrato_id)
    ->where('planillas.tipo_planilla_id', '3')
    ->select('planilla_movimientos.id','planilla_movimientos.planilla_id','planilla_movimientos.planilla_item_id','planilla_movimientos.precio_unitario',  
    DB::raw('SUM(planilla_movimientos.cantidad) as cantidad'))
    ->groupBy('planilla_movimientos.planilla_item_id','planilla_movimientos.precio_unitario','planilla_movimientos.id','planilla_movimientos.planilla_id')
    ->get();
   

    $obj = json_decode($avance, true);

    return $obj;

    }

    public function getAvanceFinaciero($contrato_id)
    {

         // getanticipo
         $anti = DB::table('proceder_ordenes')
         ->where('document_id',$contrato_id)
         ->select('fecha_orden_proceder', 'anticipo')->first();
         
         $fecha_orden_proceder=$anti->fecha_orden_proceder;
         $anticipo=$anti->anticipo;
         
         //$obj = json_decode($anti, true);
        // $anti = json_decode($obj, true);
        

        // llamar a getPlanila
        $plani= Planilla::where('contrato_id', $contrato_id)->get();

        $obj = json_decode($plani, true);

        //armamos la debe, haber saldo
        $actualVigente=0;
        for($i = 0; $i < count( $obj); $i++) {

            $items[$i]['fecha']=$obj[$i]['fecha_planilla'];
            $items[$i]['f_fecha']=date("d-m-Y", strtotime($obj[$i]['fecha_planilla']));
            $items[$i]['numero_planilla']=$obj[$i]['numero_planilla'];

            switch ($obj[$i]['tipo_planilla_id']) {
                case 1:
                    $items[$i]['tipo']= "Saldo Inicial";
                    break;
                case 2:
                    $items[$i]['tipo']= "Modificacion";
                    break;
                case 3:
                    $items[$i]['tipo']= "Avance";
                    break;
                default:
                    $items[$i]['tipo']= "-";
            }
           
          
            $items[$i]['vigente']=$actualVigente;
            $items[$i]['total_planilla']=$obj[$i]['total_planilla'];
            $items[$i]['anticipo_planilla']=$obj[$i]['anticipo_planilla'];
            $items[$i]['retencion_planilla']= $obj[$i]['retencion_planilla'];
            
            // ponemo los numeros en formato
            $items[$i]['f_vigente']=   number_format( $items[$i]['vigente'],2,",",".");
            $items[$i]['f_total_planilla']=   number_format( $items[$i]['total_planilla'],2,",",".");
            $items[$i]['f_anticipo_planilla']=  number_format( $items[$i]['anticipo_planilla'],2,",",".");
            $items[$i]['f_retencion_planilla']=  number_format($items[$i]['retencion_planilla'],2,",",".");


          



           
            if ($obj[$i]['tipo_planilla_id']==1 ) {

                $items[$i]['total_planilla']=$obj[$i]['total_planilla'];
                $items[$i]['anticipo_planilla']=$anticipo;
                $items[$i]['retencion_planilla']= 0;
                $items[$i]['vigente']=$obj[$i]['total_planilla'];
                $items[$i]['f_vigente']=   number_format( $items[$i]['vigente'],2,",",".");
              }
//calculamos saldo
            if ($i==0 ) {
                
                $items[$i]['s_contrato']=  $items[$i]['total_planilla'];
                $items[$i]['s_anticipo']=  $items[$i]['anticipo_planilla'];
                $items[$i]['s_retencion']=0;
                $items[$i]['avance']=0;
                $items[$i]['avAcumulado']=0;
               $actualVigente=$i;

            } else  { 
                $items[$i]['vigente']=$actualVigente;

                if ($obj[$i]['tipo_planilla_id']==2 ) {

                    if ($obj[$i]['total_planilla']!=0 ) {
    
                            // esto quiere decir que ha habido un cambio en el monto del contrato.
    
                            $items[$i]['vigente']= $obj[$i]['total_planilla'];
                            $items[$i]['f_vigente']=   number_format( $items[$i]['vigente'],2,",",".");
                            $items[$i]['total_planilla']=$items[$actualVigente]['vigente']-$items[$i]['vigente'];
                            $items[$i]['f_total_planilla']=   number_format( $items[$i]['total_planilla'],2,",",".");
                            $actualVigente=$i;
    
                            //$items[$i]['total_planilla']= $items[$i-1]['vigente']- $items[$i]['vigente'];
    
    
                    }
    
    
                }





                
                $items[$i]['s_contrato']= $items[$i-1]['s_contrato']-( $items[$i]['total_planilla']);
                $items[$i]['s_anticipo']= $items[$i-1]['s_anticipo']-( $items[$i]['anticipo_planilla']);
                $items[$i]['s_retencion']=$items[$i-1]['s_retencion']+( $items[$i]['retencion_planilla']);

                $items[$i]['avance']= (($obj[$i]['tipo_planilla_id']==2 ) and ($actualVigente!=0 ) ) ?
                
                 
                    number_format(($items[$i]['total_planilla']/$items[$i-1]['s_contrato']),3,",",".") :
                        number_format((1-($items[$i]['s_contrato']/$items[$i-1]['s_contrato']))*100,3,",",".") ;



                $items[$i]['avAcumulado']= number_format((1-($items[$i]['s_contrato']/$items[$actualVigente]['s_contrato']))*100,2,",",".");
            }




           


           

            $items[$i]['f_s_contrato']= number_format($items[$i]['s_contrato'],2,",",".");
            $items[$i]['f_s_anticipo']= number_format($items[$i]['s_anticipo'],2,",",".");
            $items[$i]['f_s_retencion']=number_format($items[$i]['s_retencion'],2,",",".");

                     
           
        }



        return $items;


    }

    public function getAvanceFisicoComponentes($contrato_id)
    {

        // seleccionamos todos lo que tiene contrato_d como padre y que se un documento de modificacion de dnero esas modifican planilla
        // SELECT * FROM `documents` WHERE `document_types_id` = 5 AND `padre` = $contrato_id 
        //AND (`modifica` LIKE '%2%' or `modifica` LIKE '%3%') ORDER  BY fecha_firma DESC LIMIT  1;

     
        $vigente = DB::select('SELECT * FROM documents WHERE document_types_id = 5 AND padre = '.$contrato_id.' AND (modifica LIKE "%2%" or modifica LIKE "%3%") ORDER  BY fecha_firma DESC LIMIT  1');
        foreach ($vigente as $json) {
            $doc_vig_id =$json->id;
        }
        $pla_vigente= DB::table('planilla_documents')->where('document_id',  $doc_vig_id )->first();
        $pla_vig_id= $pla_vigente->planilla_id;


        // obtenemos la planilla vigente 
        //SELECT i.id, contrato_id, i.tipo, i.padre, i.item_codigo, i.item_descripcion, u.simbolo FROM planilla_items i, unidades u WHERE u.id=i.unidad_id and i.contrato_id=24 order by i.item_codigo;


       /*---------------------------------------------------------------------------------------------------------------------
        Obtenemos la planilla: $planilla_id y $contrato_id
        SELECT i.id, contrato_id, i.tipo, i.padre, i.item_codigo, i.item_descripcion, u.simbolo, m.cantidad, m.precio_unitario, (m.cantidad*m.precio_unitario) as total 
        FROM planilla_items i, unidades u, planilla_movimientos m 
        WHERE u.id=i.unidad_id and i.id=m.planilla_item_id and i.contrato_id=24 and m.planilla_id=91
        order by i.item_codigo;
        -------------------------------------------------------------------------------------------------------*/
      

        $vigenteTotalComponente= DB::table('planilla_items')
        ->join('planilla_movimientos', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->where('planilla_items.contrato_id', $contrato_id)
        ->where('planilla_movimientos.planilla_id', $pla_vig_id)
        ->selectRaw('planilla_items.padre, sum(planilla_movimientos.cantidad*planilla_movimientos.precio_unitario) as total')
        ->groupBy('planilla_items.padre')
        ->orderBy('planilla_items.padre')
        ->get();

        $i=0;
        foreach ($vigenteTotalComponente as $json) {
            $i++;
            $vigenteA[$i]['padre']=$json->padre;
            $vigenteA[$i]['total']=$json->total;
        }




        $componentes = DB::select('SELECT id, item_codigo, item_descripcion FROM planilla_items WHERE  contrato_id='.$contrato_id.' and tipo="G";');
        $i=0;
        $items[0]['id']=0;
        $items[0]['item_codigo']='-';
        $items[0]['item_descripcion']='Total Proyecto';
                  
        foreach ($componentes as $json) {
            $i++;
            $items[$i]['id']=$json->id;
            $items[$i]['item_codigo']=$json->item_codigo;
            $items[$i]['item_descripcion']=$json->item_descripcion;
        }

      

        $item_id = array_column($vigenteA, 'padre'); //del array bidimensional solo sacamos la columna que en la que queremos buscar
        $sumVigente=0;
        for($i = 1; $i < count( $items); $i++) {
            $padre=$items[$i]['id'];
            // buscamos padre en items y le ponemos el total
            $clave = array_search( $padre, $item_id); // buscamos en nuestra columna, podemos hacer lo mismo reemplasando item_id por su comando
            $items[$clave]['vigente']= $vigenteA[$clave+1]['total'];
            $sumVigente=$sumVigente+ $items[$clave]['vigente'];
            $items[$clave]['f_vigente']= number_format($items[$clave]['vigente'],2,",",".");

        }
        $items[0]['vigente']= $sumVigente;
        $items[0]['f_vigente']=number_format($items[0]['vigente'],2,",",".");

        /*----------------------------------------------------------------------------------------------------
        / Calculamos el acumulado y otro valores $acumuladoTotalComponente
        /----------------------------------------------------------------------------------------------------*/


        $acumuladoTotalComponente= DB::table('planilla_items')
        ->join('planilla_movimientos', 'planilla_movimientos.planilla_item_id', '=', 'planilla_items.id')
        ->join('planillas', 'planillas.id', '=', 'planilla_movimientos.planilla_id')
        ->where('planilla_items.contrato_id', $contrato_id)
        ->where('planillas.tipo_planilla_id', '3')
        ->selectRaw('planilla_items.padre, sum(planilla_movimientos.cantidad*planilla_movimientos.precio_unitario) as total')
        ->groupBy('planilla_items.padre')
        ->orderBy('planilla_items.padre')
        ->get();

        $i=0;
        foreach ($acumuladoTotalComponente as $json) {
            $i++;
            $acumuladoA[$i]['padre']=$json->padre;
            $acumuladoA[$i]['total']=$json->total;
        }

        $sumAcumulado=0;
        for($i = 1; $i < count( $items); $i++) {
            $padre=$items[$i]['id'];
            // buscamos padre en items y le ponemos el total
            $clave = array_search( $padre, $item_id); // buscamos en nuestra columna, podemos hacer lo mismo reemplasando item_id por su comando
            $items[$clave]['acumulado']= $acumuladoA[$clave+1]['total'];
            $sumAcumulado=$sumAcumulado+ $items[$clave]['acumulado'];
            $items[$clave]['f_acumulado']= number_format($items[$clave]['acumulado'],2,",",".");

            $items[$clave]['saldo']=$items[$clave]['vigente']- $items[$clave]['acumulado'];
            $items[$clave]['f_saldo']= number_format($items[$clave]['saldo'],2,",",".");

            $items[$clave]['porcentaje']=($items[$clave]['acumulado']/ $items[$clave]['vigente'])*100;
            $items[$clave]['f_porcentaje']= number_format($items[$clave]['porcentaje'],2,",",".");


        }
        $items[0]['acumulado']= $sumAcumulado;
        $items[0]['f_acumulado']=number_format($items[0]['acumulado'],2,",",".");

        $items[0]['saldo']= $items[0]['vigente']- $items[0]['acumulado'];
        $items[0]['f_saldo']=number_format($items[0]['saldo'],2,",",".");

        $items[0]['porcentaje']=($items[0]['acumulado']/ $items[0]['vigente'])*100;
         $items[0]['f_porcentaje']= number_format($items[0]['porcentaje'],2,",",".");

/*--------------------------------------------------------------------------------------------------------------
/ dump($acumuladoA);
dump($item_id);
dump($items);
*/





        return  $items;

    }

}
