<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Constructor\Unidad;



class RequerimientoItem extends Model
{
    use HasFactory;
protected $fillable = [
    'requerimiento_id',
    'requerimiento_recurso_id',
    'cantidad_recurso',
    'horas_recurso',
    'dias_recurso',
    'tiempo_total_recurso',
    'precio_referencia_recurso'

];


public function recursos()
    {
        return $this->belongsTo(RequerimientoRecursos::class, 'requerimiento_recurso_id', 'id');
    }

public function getReqItems($requerimiento_id)
    {
        $items=[];
        $json = RequerimientoItem::where('requerimiento_id', $requerimiento_id)
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



        return $items;


    }


    
}
