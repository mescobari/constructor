<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Constructor\document;
use App\Models\Constructor\Planilla;
use Brick\Math\BigInteger;

class PlanillaController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$planilla es el id de un contrato principal o de un subcontrato
        // verificamos
        $documentosHijos = document::where('padre',$id)->get();
// se debe sumar planilladel contrato principal con los modificatorios mas ordenes de cambio, etc para sacar el vigente
// de debe sumar todas las planillas de avance para sacar el avance total y posterior calculara el saldo.

        foreach ($documentosHijos as $key => $doc) {
          // $documentosHijos es una Instancia de la clase documents
        }


        $data = Planilla::where('documents_id',$id)->get();;
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
