<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Constructor\Unidad;

class PlanillaItem extends Model
{
    use HasFactory;

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id', 'id');
    }

    

    public function getEstructuraItems($contrato_id)
    {
        $items=[];
        $j=0;
        $json=PlanillaItem::where('contrato_id',$contrato_id )->with('Unidad')->get();
        $obj = json_decode($json, true);
        //obtenemos los campos que nos interesan
        for($i = 0; $i < count( $obj); $i++) {
            $items[$i]['id']=$obj[$i]['id'];
            $items[$i]['padre']=$obj[$i]['padre'];
            $items[$i]['tipo']=$obj[$i]['tipo'];
            $items[$i]['item_codigo']=$obj[$i]['item_codigo'];
            $items[$i]['item_descripcion']=$obj[$i]['item_descripcion'];
            $items[$i]['simbolo']=$obj[$i]['unidad']['simbolo'];

            if ( $items[$i]['padre']==0) {
                $patriarca[]= $items[$i];

            }
        }
          // ordenamos de acuerdo a padre y relaciones
            //
            $k=0;

          for($i = 0; $i < count( $patriarca); $i++) {
            $orden[$k]= $patriarca[$i];

            $padre=$orden[$k]['id'];
            for($j = 0; $j < count( $items); $j++) {
                
                if ( $items[$j]['padre']==$padre) {
                    $k++;
                    $orden[$k]= $items[$j];
                    // ahora verificamos si este tiene hijos
                    $padre1=$orden[$k]['id'];

                    for($z = 0; $z < count( $items); $z++) {
                        if ( $items[$z]['padre']==$padre1) {
                            $k++;
                            $orden[$k]= $items[$z];
                            // un nivel mas, despues debemos refactorizar
                            $padre2=$orden[$k]['id'];
                            for($w = 0; $w < count( $items); $w++) {
                                if ( $items[$w]['padre']==$padre2) {
                                    $k++;
                                    $orden[$k]= $items[$w];

                                }
                            }



                        }
                    }
    
                }
            
            }
            $k++;
         }
         
 
        return $orden;
    }







}
