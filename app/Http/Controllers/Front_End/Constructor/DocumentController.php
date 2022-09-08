<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use App\Models\Constructor\OrdenesProceder;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Constructor\document;
use App\Models\Constructor\UnidadEjecutora;
use App\Models\FrontEnd\usuarios\Funcionario;
use App\Models\Responsables;

use Illuminate\Support\Facades\Storage;


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
        //verificar para que contratos esta habilitado el usuario
        $users_id = auth()->user()->id;
        if ($users_id > 2) {
            // obtenemo ahora el funcionario_id
            $funcionario_id = Funcionario::find($users_id)->id;
            // ahora debemos encontrar el id del responsable, un funcionario puede estar asignado a mas de un proyecto.
            $resp = Responsables::select('documents_id')->where('funcionario_id', '=', $funcionario_id)->get()->toarray();

            return document::whereIn('id', $resp)->get();
        } else {
            return document::all();
        }
    }

    public function listar_ue()
    {
        //
        return UnidadEjecutora::all();
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
        //get the file from the request and store

//        $insert_id = DB::table('documents')->insertGetId(['id'=> $request->input('')]);
        $files = "";
        $path = "";
        if ($request->hasFile('files')) {
//            $extension = $request->file('files')->getClientOriginalExtension();
            $nombre_carpeta = "/constructor/documentos";
//            $path = $nombre_carpeta . '/' . $nombre_archivo;
//            $files = storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);
            $files = $request->file('files');
            $nombre_archivo = $request->padre . '-' . $request->document_types_id . '-' . $_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
        };
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
     * @param \App\Models\Constructor\document $document
     * @return \Illuminate\Http\Response
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Constructor\document $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(document $document)
    {
        $doc_edit = document::find($document->id);


        return response()->json($doc_edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Constructor\document $document
     * @return document
     */
    public function update(Request $request, $id)
    {
//        $documentId = document::findOrFail($document->id);
        $documentId = document::findOrFail($id);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $nombre_carpeta = "/constructor/documentos";
            $nombre_archivo = $request->document_types_id . '-' . $_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
            $documentId->path_contrato = $path;
        }
        $documentId->document_types_id = $request->document_types_id;
        $documentId->nombre = $request->nombre;
        $documentId->codigo = $request->codigo;
        $documentId->contratante_id = $request->contratante_id;
        $documentId->contratado_id = $request->contratado_id;
        $documentId->duracion_dias = $request->duracion_dias;
        $documentId->fecha_firma = $request->fecha_firma;
        $documentId->monto_bs = $request->monto_bs;
        $documentId->objeto = $request->objeto;
        $documentId->modifica = $request->modifica;
        $documentId->padre = $request->padre;
        $documentId->unidad_ejecutora_id = $request->unidad_ejecutora_id;
//        $document->path_contrato = $file;
        $documentId->save();

//        return $document;
//        $updateDoc = document::update([
//            'document_types_id' => $documentId->document_types_id,
//            'unidad_ejecutora_id' => $documentId->unidad_ejecutora_id,
//            'padre' => $documentId->padre,
//            'nombre' => $documentId->nombre,
//            'codigo' => $documentId->codigo,
//            'contratante_id' => $documentId->contratante_id,
//            'contratado_id' => $documentId->contratado_id,
//            'duracion_dias' => $documentId->duracion_dias,
//            'fecha_firma' => $documentId->fecha_firma,
//            'monto_bs' => $documentId->monto_bs,
//            'objeto' => $documentId->objeto,
//            'modifica' => $documentId->modifica,
////            'path_contrato' => $documentId->$path,
//        ]);
//        return $updateDoc;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Constructor\document $document
     * @return string
     */
    public function destroy(document $document)
    {
        $document = document::findOrFail($document->id);
        $document->delete();
        return $document;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateContrato(Request $request, $id)
    {
        $documentId = document::findOrFail($id);
        $path = "";
        $files = "";
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $nombre_carpeta = "constructor/documentos";
            $nombre_archivo = $request->document_types_id . '-' . $_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
        } else {
            $path = $documentId->path_contrato;
        }
        return $documentId->update([
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
     * @throws FileNotFoundException
     */
    public function downloadDocument($id)
    {
        $document = document::findOrFail($id);
        $path = $document->path_contrato;
        $file = Storage::disk('local')->get($path);
        return response($file, 200)->header('Content-Type', 'octet-stream');
    }

    public function getOrdenesProceder()
    {
        return OrdenesProceder::all();
    }

    public function uploadOrdenFile(Request $request)
    {
        if($request->hasFile('files')){

            $files = request()->file('files');
            $nombre_carpeta = "constructor/ordenes_proceder";
            $nombre_archivo = $_FILES['files']['name'];
            $path = $files->storeAs($nombre_carpeta, $nombre_archivo);
        }
        return OrdenesProceder::create([
            'document_id' => $request->document_id,
            'fecha_orden_proceder' => $request->fecha_orden_proceder,
            'desc_orden_proceder' => $request->desc_orden_proceder,
            'path_orden_proceder' => $path,
        ]);
    }
}
