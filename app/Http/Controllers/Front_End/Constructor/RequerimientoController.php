<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Models\Constructor\Requerimiento;

use App\Http\Controllers\Controller;
use App\Models\Constructor\RequerimientoItem;
use App\Models\Constructor\RequerimientoOtros;
use App\Models\Constructor\RequerimientoRecursos;
use App\Models\Constructor\RequerimientoRelacion;
use App\Models\Constructor\Unidad;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequerimientoController extends Controller
{



    public function createRequerimiento(Request $request)
    {
        $path = "";
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $nombre_carpeta = "/constructor/documentos";
            $nombre_archivo = $request->document_types_id . '-' . $_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
        }

        return Requerimiento::create([
            'document_id' => $request->document_id,
            'tipo_requerimiento_id' => $request->tipo_requerimiento_id,
            'correlativo_requerimiento' => $request->correlativo_requerimiento,
            'fecha_requerimiento' => $request->fecha_requerimiento,
            'nuri_requerimiento' => $request->nuri_requerimiento,
            'descripcion_requerimiento' => $request->descripcion_requerimiento,
            'trabajos_encarados' => $request->trabajos_encarados,
            'gastos_generales' => $request->gastos_generales,
            'path_requerimientos' => $path,
        ]);
    }

    public function createRequerimientoOtrosGastos(Request $request)
    {
        return RequerimientoOtros::create([
            'requerimiento_id' => $request->requerimiento_id,
            'requerimiento_recurso_id' => $request->requerimiento_recurso_id,
            'cantidad_otros' => $request->cantidad_otros,
            'monto_otros' => $request->monto_otros,
            'explicar_otros' => $request->explicar_otros,
        ]);
    }

    public function createRequerimientoRelacion(Request $request)
    {
        return RequerimientoRelacion::create([
            'requerimiento_id' => $request->requerimiento_id,
            'planilla_item_id' => $request->planilla_item_id,
            'vigente' => $request->vigente,
            'avance' => $request->avance,
            'estimado' => $request->estimado,
            'precio_unitario' => $request->precio_unitario,
        ]);
    }

    public function getRequerimientoOtrosGastos(){
        return RequerimientoOtros::all();
    }

    public function getRequerimientoRelacion()
    {
        return RequerimientoRelacion::all();
    }

    public function getRequerimientoItems()
    {
        return RequerimientoItem::all();
    }

    public function getUnidades()
    {
        return Unidad::all();
    }

    public function getRequerimientos()
    {
        return Requerimiento::all();
    }

    public function inicio()
    {
        return view('front-end.constructor.IndexRequerimientos');
    }

    public function listaReq()
    {
        return view('front-end.constructor.ListaRequerimientos');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Requerimiento[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return RequerimientoRecursos::all();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $re_item = new RequerimientoItem;
        $re_item->requerimiento_id = $request->requerimiento_id;
        $re_item->requerimiento_recurso_id = $request->requerimiento_recurso_id;
        $re_item->cantidad_recurso = $request->cantidad_recurso;
        $re_item->horas_recurso = $request->horas_recurso;
        $re_item->dias_recurso = $request->dias_recurso;
        $re_item->tiempo_total_recurso = $request->tiempo_total_recurso;
        $re_item->precio_referencia_recurso = $request->precio_referencia_recurso;
        $re_item->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Constructor\Requerimiento $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Constructor\Requerimiento $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Constructor\Requerimiento $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Constructor\Requerimiento $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requerimiento = Requerimiento::findOrFail($id);
        $requerimiento->delete();
        return $requerimiento;
    }

    public function deleteItemObra($id)
    {
        $requerimientoItemObra = RequerimientoItem::findOrFail($id);
        $requerimientoItemObra->delete();
        return $requerimientoItemObra;
    }

    public function deleteItemRelacion($id){
        $requerimientoItemRelacion = RequerimientoRelacion::findOrFail($id);
        $requerimientoItemRelacion->delete();
        return $requerimientoItemRelacion;
    }

    public function deleteItemOtrosGastos($id)
    {
        $requerimientoOtros = RequerimientoOtros::findOrFail($id);
        $requerimientoOtros->delete();
        return $requerimientoOtros;
    }

    public function updateRequerimientoItem(Request $request, $id)
    {
        $itemAndId = RequerimientoItem::findOrFail($id);

        return $itemAndId->update([
            'requerimiento_id' => $request->requerimiento_id,
            'requerimiento_recurso_id' => $request->requerimiento_recurso_id,
            'cantidad_recurso' => $request->cantidad_recurso,
            'horas_recurso' => $request->horas_recurso,
            'dias_recurso' => $request->dias_recurso,
            'tiempo_total_recurso' => $request->tiempo_total_recurso,
            'precio_referencia_recurso' => $request->precio_referencia_recurso,
        ]);

//        $itemAndId->requerimiento_id = $request->requerimiento_id;
//        $itemAndId->requerimiento_recurso_id = $request->requerimiento_recurso_id;
//        $itemAndId->cantidad_recurso = $request->cantidad_recurso;
//        $itemAndId->horas_recurso = $request->horas_recurso;
//        $itemAndId->dias_recurso = $request->dias_recurso;
//        $itemAndId->tiempo_total_recurso = $request->tiempo_total_recurso;
//        $itemAndId->precio_referencia_recurso = $request->precio_referencia_recurso;
//        $itemAndId->save();
    }
}
