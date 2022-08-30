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
                        // calcular total
                        $total=$total+$items[$i]['monto'];
                        
                        $items[$i]['monto']=number_format($items[$i]['monto'],2,",",".");
                        $items[$i]['vigente']=number_format($items[$i]['vigente'],2,",",".");
                        $items[$i]['precio_unitario']=number_format($items[$i]['precio_unitario'],2,",",".");
                        $items[$i]['avance']=number_format($items[$i]['avance'],2,",",".");
                        $items[$i]['saldo']=number_format($items[$i]['saldo'],2,",",".");
                        $items[$i]['estimado']=number_format($items[$i]['estimado'],2,",",".");
                    
        }
                
                
                // creMOS L NE DE TOTAL
                $items[$i]['planilla_item_id']=0;
                $items[$i]['item_codigo']='-';
                $items[$i]['item_descripcion']='Monto Total a ser Facturado:';
                $items[$i]['simbolo']='Bs.';
            
                $items[$i]['vigente']='';
                $items[$i]['precio_unitario']='';

                $items[$i]['avance']='';
                $items[$i]['precio_unitario1']='';
                $items[$i]['saldo']='';

                $items[$i]['estimado']='';
                $items[$i]['monto']=number_format($total,2,",",".");

       return $items;
   }


}
