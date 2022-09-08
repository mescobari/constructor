<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Constructor\PlanillaItem;
use App\Models\Constructor\PlanillaMovimiento;

use Illuminate\Http\Request;

use App\Models\Constructor\document;
use App\Models\Constructor\Planilla;
use Brick\Math\BigInteger;

class PlanillaController extends Controller
{
    public function getPlanillaItem(){
        return PlanillaItem::all();
    }
    public function inicio()
    {
        return view('front-end.constructor.IndexPlanillas');
    }


    public function planillaCSV(Request $request)
    {
        //lo utilizamos para no crear mas rutas, no permite verificar para cargar planillas items por items
        // jalar 
        $tipo_planilla_id=$request->tipo_planilla_id;
        $contrato_id=$request->contrato_id;
        $inicial=DB::table('planillas')
        ->join('planilla_movimientos', 'planillas.id', '=', 'planilla_movimientos.planilla_id')
        ->where('planillas.contrato_id', '=', $contrato_id)
        ->where('planillas.tipo_planilla_id', '=', '1')
        ->select('planilla_movimientos.planilla_id', 'planillas.tipo_planilla_id')->distinct()
        ->get();

        If ((count($inicial)==0)  and ($tipo_planilla_id==1)){


            $mensaje='PUEDE CARGAR LA Planilla  inicial';
            return $mensaje;

        }

        If ((count($inicial)>0)  and ($tipo_planilla_id!=1)){

            $mensaje='PUEDE CARGAR YA ESTA CARGADA LA PLANILLA INICIAL Y ES DE OTRO TIPO';
        return $mensaje;

        }
        //$existe=PlanillaItem::whereb
        $mensaje=1;
        return $mensaje;

    }

    public function getValoresItem($id){

        $json=PlanillaItem::where('id',$id )->with('Unidad')->first();
        $contrato_id=$json->contrato_id;
        $planilla_item_id=$id;

        $obj = json_decode($json, true);

        $items[0]['id']=$id;
        $items[0]['item_codigo']=$json->item_codigo;
        $items[0]['item_descripcion']=$json->item_descripcion;
        $items[0]['simbolo']=$json->unidad->simbolo;


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
                
                    $items[0]['vigente']=$obj1[0]['cantidad'];
                    $items[0]['precio_unitario']=$obj1[0]['precio_unitario'];

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

                    $items[0]['avance']=$obj1[0]['avance'];
                    $items[0]['precio_unit_avance']=$obj1[0]['precio_unitario'];

                    // calculamos el saldo
                    $items[0]['saldo']=$items[0]['vigente']- $items[0]['avance'];
                    $items[0]['monto_por_cobrar']=$items[0]['saldo']*$items[0]['precio_unitario'];
                    
                    
                    $items[0]['fvigente']=number_format($items[0]['vigente'],2,",",".");
                    $items[0]['fprecio_unitario']=number_format($items[0]['precio_unitario'],2,",",".");
                    $items[0]['favance']=number_format($items[0]['avance'],2,",",".");
                    $items[0]['fprecio_unit_avance']=number_format($items[0]['precio_unit_avance'],2,",",".");
                    $items[0]['fsaldo']=number_format($items[0]['saldo'],2,",",".");
                    $items[0]['fmonto_por_cobrar']=number_format($items[0]['monto_por_cobrar'],2,",",".");
                
    
        return $items;
    }


    public function index()
    {
        //lo utilizamos para no crear mas rutas, no permite verificar para cargar planillas items por items
        // jalar 
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //subimos el archivo y armamos el path doc
        if($request->hasFile('files')){
            $extension = $request->file('files')->getClientOriginalExtension();
            $nombre_carpeta = "/constructor";
            $nombre_archivo = $request->contrato_id.'_pla_'.$_FILES['files']['name'];
            $path= $nombre_carpeta.'/'.$nombre_archivo;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador

            //dd($_FILES);

        }

        // grbamos en planilla


      $planilla_save = Planilla::create([
            'tipo_planilla_id'=>$request->tipo_planilla_id,
            'contrato_id'=>$request->contrato_id,
           'numero_planilla'=>$request->numero_planilla,
            'nuri_planilla'=>$request->nuri_planilla,
            'fecha_planilla'=>$request->fecha1,
             'total_planilla'=>$request->total_planilla,
            'anticipo_planilla'=>$request->anticipo_planilla,
            'retencion_planilla'=>$request->retencion_planilla,
            'referencia'=>$request->referencia,
            'path_planilla'=>$path,
        ]);


        //$mensaje='volviendo del backend grabar path documento '.$path;
        return $planilla_save;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $data = Planilla::where('contrato_id',$id)->get();
        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Planilla $planilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planilla $planilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planilla $planilla)
    {
        //
    }

}
