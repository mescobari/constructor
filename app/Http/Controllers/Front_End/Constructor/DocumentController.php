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
    //     public function documentSave(Request $request){
    //
    //         $d = document::create([
    //                     'document_types_id' => $request->document_types_id,
    //                     'unidad_ejecutora_id' => $request->unidad_ejecutora_id,
    //                     'padre' => $request->padre,
    //                     'nombre' => $request->nombre,
    //                     'codigo' => $request->codigo,
    //                     'contratante_id' => $request->contratante_id,
    //                     'contratado_id' => $request->contratado_id,
    //                     'duracion_dias' => $request->duracion_dias,
    // //                      'fecha_firma' => date('d-m-Y', strtotime($request->fecha_firma)),
    //                     'fecha_firma' => $request->fecha_firma,
    //                     'monto_bs' => $request->monto_bs,
    //                     'objeto' => $request->objeto,
    //                     'modifica' => $request->modifica,
    //                     'path_contrato' => $request->path_contrato,
    //             ]);
    //             return $d;
    //     }
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
        $files = "";
        $path = "";
        if ($request->hasFile('files')) {
            $extension = $request->file('files')->getClientOriginalExtension();
            $nombre_carpeta = "/constructor";
            $nombre_archivo = $_FILES['files']['name'];
            $path = $nombre_carpeta . '/' . $nombre_archivo;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);
        }
        $d = document::create([
            'document_types_id' => $request->document_types_id,
            'unidad_ejecutora_id' => $request->unidad_ejecutora_id,
            'padre' => $request->padre,
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'contratante_id' => $request->contratante_id,
            'contratado_id' => $request->contratado_id,
            'duracion_dias' => $request->duracion_dias,
            'fecha_firma' => $request->fecha_firma,
            'monto_bs' => $request->monto_bs,
            'objeto' => $request->objeto,
            'modifica' => $request->modifica,
            'path_contrato' => $path,
        ]);
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
