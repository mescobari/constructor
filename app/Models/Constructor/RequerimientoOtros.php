<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Constructor\Unidad;

class RequerimientoOtros extends Model
{
    use HasFactory;
    protected $fillable = [
        'requerimiento_id',
        'requerimiento_recurso_id',
        'cantidad_otros',
        'monto_otros',
        'explicar_otros',
    ];

    public function recursos()
    {
        return $this->belongsTo(RequerimientoRecursos::class, 'requerimiento_recurso_id', 'id');
    }


    public function getReqOtros($requerimiento_id)
    {
        $items=[];
        $json = RequerimientoOtros::where('requerimiento_id', $requerimiento_id)
        ->with('recursos')        
        ->get();
       
              
        $obj = json_decode($json, true);
        $total=0;


       for($i = 0; $i < count( $obj); $i++) {
            $items[$i]['id']=$obj[$i]['id'];
            $items[$i]['codigo_recurso']=$obj[$i]['recursos']['codigo_recurso'];
            $items[$i]['descripcion_recurso']=$obj[$i]['recursos']['descripcion_recurso'];
           
            $simbolo=Unidad::find($obj[$i]['recursos']['unidad_id']);
            $items[$i]['simbolo']=$simbolo->simbolo;

            $items[$i]['cantidad_otros']=$obj[$i]['cantidad_otros'];
            $items[$i]['monto_otros']=$obj[$i]['monto_otros'];
            $items[$i]['total_otros']=$obj[$i]['cantidad_otros']*$obj[$i]['monto_otros'];
            $items[$i]['explicar_otros']=$obj[$i]['explicar_otros'];

           
           // calcular total
     
             $total=$total+$items[$i]['total_otros'];

             $items[$i]['cantidad_otros']=number_format($items[$i]['cantidad_otros'],2,",",".");
            $items[$i]['monto_otros']=number_format($items[$i]['monto_otros'],2,",",".");
            $items[$i]['total_otros']=number_format( $items[$i]['total_otros'],2,",",".");
           
        }
        // creamos linea DE TOTAL

        $items[$i]['id']=0;
        $items[$i]['codigo_recurso']='';
        $items[$i]['descripcion_recurso']='Monto total Otros Gastos:';

        $items[$i]['simbolo']='Bs.';

        $items[$i]['cantidad_otros']='';
        $items[$i]['monto_otros']='';
        $items[$i]['total_otros']= number_format($total,2,",",".");
        $items[$i]['explicar_otros']='';

       
        return $items;


    }

}
