<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Constructor'], function () {
    Route::get('unidad_ejec', 'UnidadEjecutoraController@inicio')->name('unidad_ejec');  //menu
    Route::get('contrato_prin', 'ContratoPrincipalController@inicio')->name('contrato_prin');  //menu
    Route::get('listar_unidades_ejecutoras', 'UnidadEjecutoraController@listarUnidadesEjecutoras')->name('listar_unidades_ejecutoras');
    Route::get('get_unidades_ejecutoras', 'UnidadEjecutoraController@getUnidadesEjecutoras')->name('get_unidades_ejecutoras');
    Route::apiResource('unidades_ejecutoras', UnidadEjecutoraController::class);
    Route::post('update_contrato/{id}', 'DocumentController@updateContrato');
    Route::get('documents_ini', 'DocumentController@inicio')->name('documents_ini');
    Route::get('download_document/{id}', 'DocumentController@downloadDocument')->name('download_document');
    Route::apiResource('documents', DocumentController::class);
    Route::get('get_ordenes_proceder', 'DocumentController@getOrdenesProceder')->name('get_ordenes_proceder');
    Route::post('upload_orden_file', 'DocumentController@uploadOrdenFile')->name('upload_orden_file');
    //         Route::post('document_save', 'DocumentController@documentSave')->name('document_save');


    //esta es un aruta que deberia tener su propio conrolador
    Route::get('listar_ue', 'DocumentController@listar_ue')->name('listar_ue');

//         Route::post('document_save', 'DocumentController@documentSave')->name('document_save');

    Route::get('planillas_ini', 'PlanillaController@inicio')->name('planillas_ini');
    Route::apiResource('planillas', PlanillaController::class);
    Route::get('get_planilla_item', 'PlanillaController@getPlanillaItem')->name('get_planilla_item');
    Route::get('get_valores_item/{id}', 'PlanillaController@getValoresItem')->name('get_valores_item');
    Route::post('planilla_csv', 'PlanillaController@planillaCSV')->name('planilla_csv');
    Route::post('up_load_csv', 'PlanillaController@upLoadCSV')->name('up_load_csv');
    Route::post('validar_csv', 'PlanillaController@validarCSV')->name('validar_csv');
    Route::post('procesar_csv', 'PlanillaController@procesarCSV')->name('procesar_csv');

//requerimientos
    Route::apiResource('requerimiento_recurso', RequerimientoRecursosController::class);
    Route::get('req_mano_obra', 'RequerimientoRecursosController@inicio')->name('req_mano_obra');
    Route::get('req_materiales', 'RequerimientoRecursosController@inicioMaterial')->name('req_materiales');
    Route::get(' req_equipos', 'RequerimientoRecursosController@inicioEquipos')->name('req_equipos');
    Route::get('req_fondos_avance', 'RequerimientoRecursosController@inicioFondosAvance')->name('req_fondos_avance');
    Route::post('update_req_recurso/{id}', 'RequerimientoRecursosController@updateRequerimientoRecurso')->name('update_req_mano_obra');
//    Route::get('req_materiales', 'RequerimientoMaterialesController@inicio')->name('req_materiales');

    Route::apiResource('requerimientos', RequerimientoController::class);
    Route::get('requerimientos_ini', 'RequerimientoController@inicio')->name('requerimientos_ini');
    Route::get('req_llave_mano', 'RequerimientoController@llave_mano')->name('req_llave_mano');
    Route::get('lista_req', 'RequerimientoController@listaReq')->name('lista_req');
    Route::post('create_requerimiento', 'RequerimientoController@createRequerimiento')->name('create_requerimiento');
    Route::get('get_requerimientos', 'RequerimientoController@getRequerimientos')->name('get_requerimientos');
    Route::get('get_unidades', 'RequerimientoController@getUnidades')->name('get_unidades');
    Route::get('get_requerimiento_items', 'RequerimientoController@getRequerimientoItems')->name('get_requerimiento_items');
    Route::get('update_requerimiento_item/{id}', 'RequerimientoController@updateRequerimientoItem')->name('update_requerimiento_item');
    Route::post('create_requerimiento_relacion', 'RequerimientoController@createRequerimientoRelacion')->name('create_requerimiento_relacion');
    Route::get('get_requerimiento_relacion', 'RequerimientoController@getRequerimientoRelacion')->name('get_requerimiento_relacion');
    Route::post('create_requerimiento_otros_gastos', 'RequerimientoController@createRequerimientoOtrosGastos')->name('create_requerimiento_otros_gastos');
    Route::get('get_requerimiento_otros_gastos', 'RequerimientoController@getRequerimientoOtrosGastos')->name('get_requerimiento_otros_gastos');
    Route::delete('delete_requerimiento_obra/{id}', 'RequerimientoController@deleteItemObra')->name('delete_requerimiento_obra');
    Route::delete('delete_requerimiento_relacion/{id}', 'RequerimientoController@deleteItemRelacion')->name('delete_requerimiento_relacion');
    Route::delete('delete_requerimiento_otros_gastos/{id}', 'RequerimientoController@deleteItemOtrosGastos')->name('delete_requerimiento_otros_gastos');
    Route::post('update_requerimiento_item/{id}', 'RequerimientoController@updateRequerimientoItem')->name('update_requerimiento_item');
    Route::post('update_requerimiento_relacion/{id}', 'RequerimientoController@updateRequerimientoRelacion')->name('update_requerimiento_relacion');
    Route::post('update_requerimiento_otros_gastos/{id}', 'RequerimientoController@updateRequerimientoOtrosGastos')->name('update_requerimiento_otros_gastos');
    Route::get('download_requerimiento/{id}', 'RequerimientoController@downloadRequerimiento')->name('download_requerimiento');
    Route::post('update_requerimiento_trabajos_gastos/{id}', 'RequerimientoController@updateRequerimientoTrabajosGastos')->name('update_requerimiento_trabajos_gastos');
    
    //Avance

    
    Route::apiResource('avance_prog', AvanceProgramacionController::class);
    Route::apiResource('avance_ejec', AvanceEjecucionController::class);

    Route::get('avance_prog_ini', 'AvanceProgramacionController@inicio')->name('avance_prog');
    Route::get('avance_ejec_ini', 'AvanceEjecucionController@inicio')->name('avance_ejec');


    Route::get('avan', 'AvanController@index')->name('avan');
    Route::get('avan/crear', 'AvanController@crear')->name('crear_avan');
    Route::post('avan', 'AvanController@guardar')->name('guardar_avan');
    Route::get('avan/{id}/editar', 'AvanController@editar')->name('editar_avan');
    Route::post('avan_actializar', 'AvanController@actualizar')->name('actualizar_avan');
    Route::get('avan/{id}/eliminar', 'AvanController@eliminar')->name('eliminar_avan');
    Route::post('avan/guardar-orden', 'AvanController@guardarOrden')->name('guardar_orden');


    Route::get('select_estructura', 'AvanController@estructura')->name('select_estructura');
    Route::get('ses_contrato/{id}', 'AvanController@sescontrato')->name('sescontrato');



    
    /*Route::apiResource('intervenciones', IntervencionesController::class);
    Route::post('intervenciones_mod', 'IntervencionesController@update')->name('intervenciones_mod');
    Route::get('proyectos', 'IntervencionesController@proyectos')->name('proyectos');
//create_requerimiento_otros_gastos
    Route::get('intervencion_tipo', 'TipoIntervencionesController@inicio')->name('intervencion_tipo');
    Route::get('intervencions_tipo', 'TipoIntervencionesController@intervencionesTipoActivas')->name('intervencions_tipo');
    Route::apiResource('intervenciones_tipo', TipoIntervencionesController::class);

    Route::get('sectorial', 'SectorialController@inicio')->name('intervencion_tipo');
    Route::get('sectorials', 'SectorialController@sectorialesActivas')->name('intervencions_tipo');
    Route::apiResource('sectoriales', SectorialController::class);

     */



});

?>
