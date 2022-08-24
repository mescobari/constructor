<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Planilla extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_planilla_id', 'fecha_planilla', 'contrato_id','numero_planilla', 'nuri_planilla',
     'referencia', 'path_planilla', 'total_planilla','anticipo_planilla', 'retencion_planilla' ];

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
        ->where('documents.document_types_id', '9')
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

}
