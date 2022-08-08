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

    $directory_name = "/constructor";
            $files = "";
            if($request->hasFile('files')){
                // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
                // $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo
                $extension = $request->file('files')->getClientOriginalExtension();
//                 $datoBuscar = " ";
//                 $datoReemplazar = "_";
//                 $cadenaProcesar = $request->titulo;
//                 $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);
                $name = $request->file('files')->getClientOriginalName();
                //$nombre_archivo = $request->id_proyecto . '_' . $request->id_tipo_documento . '_' . trim($titulo) . '.' . $extencion;
                $filename = $id . '-' . $document_types_id->id . '-' . $name . '.' . $extension;
                $files = $request->file('files')->storeAs('documentos/' . $directory_name, $filename);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador


            }   $d = document::create([
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
                                    'path_contrato' => $files,
                            ]);
                            return $d;
//                 $d = new document();
//                 $d->document_types_id = $request->document_types_id;
//                 $d->unidad_ejecutora_id = $request->unidad_ejecutora_id;
//                 $d->padre = $request->padre;
//                 $d->nombre = $request->nombre;
//                 $d->codigo = $request->codigo;
//                 $d->contratante_id = $request->contratante_id;
//                 $d->contratado_id = $request->contratado_id;
//                 $d->duracion_dias = $request->duracion_dias;
// //                 $d->fecha_firma = date('Y-m-d', strtotime($request->fecha_firma));
// //                 $input = Input::file('doc_upload_contrato');
// //                 $destinationPath = '/public/uploads/contratos/';
// //                 $filename = $input->getClientOriginalName();
// //                 $input->move($destinationPath, $filename);
//                 $d->fecha_firma = $request->fecha_firma;
//                 $d->monto_bs = $request->monto_bs;
//                 $d->objeto = $request->objeto;
//                 $d->modifica = $request->modifica;
//                 $d->path_contrato = $files;

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
