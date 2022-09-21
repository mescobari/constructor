<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use App\Models\Constructor\RequerimientoItem;
use App\Models\Constructor\RequerimientoRecursos;
use Illuminate\Http\Request;

class RequerimientoManoObraController extends Controller
{
    public function inicio()
    {
        return view('front-end.constructor.IndexManoObra');
    }
    /**
     * Display a listing of the resource.
     *
     * @return RequerimientoItem[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req_mano_obra = new RequerimientoRecursos();
        $req_mano_obra->tipo_requerimiento_id = $request->modal_tipo_requerimiento;
        $req_mano_obra->codigo_recurso = $request->modal_codigo;
        $req_mano_obra->descripcion_recurso = $request->modal_descripcion;
        $req_mano_obra->unidad_id = $request->modal_unidad;
        $req_mano_obra->precio_referencial = $request->modal_precio_referencial;
        $req_mano_obra->unidad_contrato = $request->modal_unidad_contrato;
        $req_mano_obra->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requerimientoRecurso = RequerimientoItem::findOrFail($id);
        $requerimientoRecurso->delete();
        return $requerimientoRecurso;
    }
}
