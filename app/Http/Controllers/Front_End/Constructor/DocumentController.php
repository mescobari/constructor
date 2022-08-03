<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Constructor\document;



class DocumentController extends Controller
{
    public function inicio()
    {
        return view('front-end.constructor.IndexDocuments');
    }
    public function documentSave(Request $request){
//          $document = new document();
//
//                     $document->document_type_id = $request->document_type_id;
//                     $document->unidad_ejecutora_id = $request->unidad_ejecutora_id;
//                     $document->padre = $request->padre;
//                     $document->nombre = $request->nombre;
//                     $document->codigo = $request->codigo;
//                     $document->contratante_id = $request->contratante_id;
//                     $document->contratado_id = $request->contratado_id;
//                     $document->duracion_dias = $request->duracion_dias;
//                     $document->fecha_firma = date('Y-m-d', strtotime($request->date_firma));
//                     $document->monto_bs = $request->monto_bs.to_string();
//                     $document->objeto = $request->objeto;
//                     $document->modifica = $request->modifica;
//                     $document->path_contrato = $request->path_contrato;
//
//                     return $document -> save();
        $d = document::create([
                    'document_type_id' => $request->document_type_id,
                    'unidad_ejecutora_id' => $request->unidad_ejecutora_id,
                    'padre' => $request->padre,
                    'nombre' => $request->nombre,
                    'codigo' => $request->codigo,
                    'contratante_id' => $request->contratante_id,
                    'contratado_id' => $request->contratado_id,
                    'duracion_dias' => $request->duracion_dias,
                    'fecha_firma' => date('Y-m-d', strtotime($request->fecha_firma)),
                    'monto_bs' => $request->monto_bs,
                    'objeto' => $request->objeto,
                    'modifica' => $request->modifica,
                    'path_contrato' => $request->path_contrato,
            ]);
            return $d;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       //
       $data = document::all();
       return $data;


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
                $d = new document();

                $d->document_type_id = $request->document_type_id;
                $d->unidad_ejecutora_id = $request->unidad_ejecutora_id;
                $d->padre = $request->padre;
                $d->nombre = $request->nombre;
                $d->codigo = $request->codigo;
                $d->contratante_id = $request->contratante_id;
                $d->contratado_id = $request->contratado_id;
                $d->duracion_dias = $request->duracion_dias;
                $d->fecha_firma = date('Y-m-d', strtotime($request->date_firma));
                $d->monto_bs = $request->monto_bs;
                $d->objeto = $request->objeto;
                $d->modifica = $request->modifica;
                $d->path_contrato = $request->path_contrato;

                $d -> save();

                return $d;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor\document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constructor\document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constructor\document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constructor\document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(document $id)
    {
        $document = document::findOrFail($id);
                $document->delete();
                return "registro eliminado";
    }
}
