<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Constructor\document;



class DocumentController extends Controller
{
    public function inicio()
    {
        return view('front-end.constructor.IndexDocuments');
    }
    /**
     * Display a listing of the resource.
     *
     * @return document[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */

    public function index()
    {
        //
        return document::all();
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
    //get the file from the request and store

//        $insert_id = DB::table('documents')->insertGetId(['id'=> $request->input('')]);
        $files = "";
        $path = "";
        if ($request->hasFile('files')) {
//            $extension = $request->file('files')->getClientOriginalExtension();
            $nombre_carpeta = "/constructor";
            $nombre_archivo = /*($insert_id + 1) . '-' .*/ $request->document_types_id . '-' . $_FILES['files']['name'];
            $path = $nombre_carpeta . '/' . $nombre_archivo;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);
        }

        return document::create([
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(document $document)
    {
        $doc_edit = document::find($document);


        return response()->json($doc_edit);
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
        $path = "";
        if ($request->hasFile('files')) {
//            $extension = $request->file('files')->getClientOriginalExtension();
            $nombre_carpeta = "/constructor";
            $nombre_archivo = /*($insert_id + 1) . '-' .*/ $request->document_types_id . '-' . $_FILES['files']['name'];
            $path = $nombre_carpeta . '/' . $nombre_archivo;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);
        }

//        return document::where('id', $request->$id)->update([
//            'document_types_id' => $request->document_types_id,
//            'unidad_ejecutora_id' => $request->unidad_ejecutora_id,
//            'padre' => $request->padre,
//            'nombre' => $request->nombre,
//            'codigo' => $request->codigo,
//            'contratante_id' => $request->contratante_id,
//            'contratado_id' => $request->contratado_id,
//            'duracion_dias' => $request->duracion_dias,
//            'fecha_firma' => $request->fecha_firma,
//            'monto_bs' => $request->monto_bs,
//            'objeto' => $request->objeto,
//            'modifica' => $request->modifica,
//            'path_contrato' => $path,
//        ]);
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
