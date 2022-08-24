<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use App\Models\Constructor\PlanillaItem;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
