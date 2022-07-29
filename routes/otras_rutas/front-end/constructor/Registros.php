<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Constructor'], function () {
        Route::get('unidad_ejec', 'UnidadEjecutoraController@inicio')->name('unidad_ejec');  //menu
        Route::get('contrato_prin', 'ContratoPrincipalController@inicio')->name('contrato_prin');  //menu
        
        Route::get('listar_unidades_ejecutoras', 'UnidadEjecutoraController@listarUnidadesEjecutoras')->name('listar_unidades_ejecutoras');  
      
        Route::apiResource('unidades_ejecutoras', UnidadEjecutoraController::class);

        Route::get('documents_ini', 'DocumentController@inicio')->name('documents_ini');  
        Route::apiResource('documents', DocumentController::class);

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