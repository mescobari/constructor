<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Constructor\Planilla;
use App\Models\Constructor\PlanillaItem;
use App\Models\Constructor\PlanillaMovimiento;

class RequerimientoRelacion extends Model
{
    use HasFactory;
    protected $fillable = ['requerimiento_id', 'planilla_item_id', 'vigente','avance', 
    'estimado', 'precio_unitario'];

   protected $table = 'requerimiento_relaciones';

   public function planillaItem()
    {
        return $this->belongsTo(PlanillaItem::class, 'requerimiento_recurso_id', 'id');
    }

   public function getReqPlanilla($requerimiento_id)
   {
      
        $req=Requerimiento::find($requerimiento_id);
        $contrato_id=$req->document_id;
        


        $items=[];
       $json = RequerimientoRelacion::where('requerimiento_id', $requerimiento_id)
       ->get();
      
             
       $obj = json_decode($json, true);
       $total=0;

       $planilla_item_id=11;
        
       
     

       for($i = 0; $i < count( $obj); $i++) {
        
                $planilla_item_id=$obj[$i]['planilla_item_id'];

                $json=PlanillaItem::where('contrato_id',$contrato_id )
                ->where('id', $planilla_item_id)
                ->with('Unidad')->first();

                $items[$i]['planilla_item_id']=$obj[$i]['planilla_item_id'];
                $items[$i]['item_codigo']=$json->item_codigo;
                $items[$i]['item_descripcion']=$json->item_descripcion;
                $items[$i]['simbolo']=$json->unidad->simbolo;

                // vigente
                    $json=DB::table('planillas')
                        ->join('planilla_movimientos','planilla_movimientos.planilla_id','planillas.id')
                        ->where('planillas.contrato_id', $contrato_id)
                        ->where('planillas.tipo_planilla_id', '2')
                        ->where('planilla_movimientos.planilla_item_id', $planilla_item_id)
                        ->orderBy('planillas.fecha_planilla')
                        ->get();

                        
                            $json=DB::table('planillas')
                            ->join('planilla_movimientos','planilla_movimientos.planilla_id','planillas.id')
                            ->where('planillas.contrato_id', $contrato_id)
                            ->where('planillas.tipo_planilla_id', '1')
                            ->where('planilla_movimientos.planilla_item_id', $planilla_item_id)
                            ->orderBy('planillas.fecha_planilla')
                            ->get();

                        
                        $obj1 = json_decode($json, true);
                    
                        $items[$i]['vigente']=$obj1[0]['cantidad'];
                        $items[$i]['precio_unitario']=$obj1[0]['precio_unitario'];

                        // avance
                        $json=DB::table('planillas')
                        ->join('planilla_movimientos','planilla_movimientos.planilla_id','planillas.id')
                        ->select(DB::raw("SUM(cantidad) as avance"), 'precio_unitario')
                        ->where('planillas.contrato_id', $contrato_id)
                        ->where('planillas.tipo_planilla_id', '3')
                        ->where('planilla_movimientos.planilla_item_id', $planilla_item_id)
                        ->groupBy('planillas.tipo_planilla_id', 'precio_unitario')
                        ->orderBy('planillas.fecha_planilla')
                        ->get();
                        $obj1 = json_decode($json, true);

                        $items[$i]['avance']=$obj1[0]['avance'];
                        $items[$i]['precio_unitario1']=$obj1[0]['precio_unitario'];

                        // calculamos el saldo
                        $items[$i]['saldo']=$items[$i]['vigente']- $items[$i]['avance'];

                        $items[$i]['estimado']=$obj[$i]['estimado'];
                        $items[$i]['monto']=$obj[$i]['estimado']*$items[$i]['precio_unitario'];
                        

           /*     

 
                        
                    $items[$i]['tipo_planilla_id']=$json->tipo_planilla_id;
                    $items[$i]['cantidad']=$json->cantidad;
                    $items[$i]['precio_unitario']=$json->precio_unitario;



                    $items[$i]['id']=$obj[$i]['id'];
                    $items[$i]['codigo_recurso']=$obj[$i]['recursos']['codigo_recurso'];
                    $items[$i]['descripcion_recurso']=$obj[$i]['recursos']['descripcion_recurso'];
                
                    $simbolo=Unidad::find($obj[$i]['recursos']['unidad_id']);
                    $items[$i]['simbolo']=$simbolo->simbolo;

                    $items[$i]['cantidad_recurso']=$obj[$i]['cantidad_recurso'];
                    $items[$i]['horas_recurso']=$obj[$i]['horas_recurso'];
                    $items[$i]['dias_recurso']=$obj[$i]['dias_recurso'];
                    $items[$i]['tiempo_total_recurso']=$obj[$i]['tiempo_total_recurso'];
                    $items[$i]['precio_referencia_recurso']=$obj[$i]['precio_referencia_recurso'];
                    $items[$i]['precio_ref']= number_format($obj[$i]['precio_referencia_recurso'],2,",",".");
                // calcular total
            
                    $total=$total+$obj[$i]['precio_referencia_recurso'];
                
                }
                
                // creMOS L NE DE TOTAL
                $items[$i]['id']=0;
                $items[$i]['codigo_recurso']='';
                $items[$i]['descripcion_recurso']='Monto total requerido:';
            
            
                $items[$i]['simbolo']='Bs.';

                $items[$i]['cantidad_recurso']='';
                $items[$i]['horas_recurso']='';
                $items[$i]['dias_recurso']='';
                $items[$i]['tiempo_total_recurso']='';
                $items[$i]['precio_referencia_recurso']=$total;
                $items[$i]['precio_ref']= number_format($total,2,",",".");



             */
           

        }



       return $items;
   }


}
