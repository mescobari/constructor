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

//         Route::post('document_save', 'DocumentController@documentSave')->name('document_save');

        Route::get('planillas_ini', 'PlanillaController@inicio')->name('planillas_ini');
        Route::apiResource('planillas', PlanillaController::class);
//requerimientos
        Route::get('requerimientos_ini', 'RequerimientoController@inicio')->name('requerimientos_ini');
        Route::apiResource('requerimientos', RequerimientoController::class);
        Route::post('create_requerimiento', 'RequerimientoController@createRequerimiento')->name('create_requerimiento');
        Route::get('get_requerimientos', 'RequerimientoController@getRequerimientos')->name('get_requerimientos');
        Route::get('get_unidades', 'RequerimientoController@getUnidades')->name('get_unidades');
        Route::get('get_requerimiento_items', 'RequerimientoController@getRequerimientoItems')->name('get_requerimiento_items');
        /*Route::apiResource('intervenciones', IntervencionesController::class);
        Route::post('intervenciones_mod', 'IntervencionesController@update')->name('intervenciones_mod');
        Route::get('proyectos', 'IntervencionesController@proyectos')->name('proyectos');

        Route::get('intervencion_tipo', 'TipoIntervencionesController@inicio')->name('intervencion_tipo');
        Route::get('intervencions_tipo', 'TipoIntervencionesController@intervencionesTipoActivas')->name('intervencions_tipo');
        Route::apiResource('intervenciones_tipo', TipoIntervencionesController::class);

        Route::get('sectorial', 'SectorialController@inicio')->name('intervencion_tipo');
        Route::get('sectorials', 'SectorialController@sectorialesActivas')->name('intervencions_tipo');
        Route::apiResource('sectoriales', SectorialController::class);

         */
    });

?>
