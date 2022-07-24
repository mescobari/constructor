<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('marco_logico', 'MarcoLogicoController@inicio')->name('marco_logico');  //menu
        Route::apiResource('marco_logicos', MarcoLogicoController::class);
        Route::post('buscar_marco_logicos', 'MarcoLogicoController@buscar_marco_logicos')->name('buscar_marco_logicos');
        Route::post('marco_logicos_mod', 'MarcoLogicoController@marco_logicos_mod')->name('marco_logicos_mod');   

        //combos segun una interseccion
        Route::get('componente_marco_logico/{id}', 'MarcoLogicoController@componente_marco_logico')->name('componente_marco_logico');   
        Route::get('producto_marco_logico/{id}', 'MarcoLogicoController@producto_marco_logico')->name('producto_marco_logico');   
        Route::get('actividad_marco_logico/{id}', 'MarcoLogicoController@actividad_marco_logico')->name('actividad_marco_logico');  
        Route::get('tarea_marco_logico/{id}', 'MarcoLogicoController@tarea_marco_logico')->name('tarea_marco_logico');   
        Route::post('buscar_arbol_marco_logico', 'MarcoLogicoController@buscar_arbol_marco_logico')->name('buscar_arbol_marco_logico'); 
        //unidad de medida y 
        Route::get('unidad_medida', 'MarcoLogicoController@unidad_medida')->name('unidad_medida');
        Route::get('frecuencia_medicion', 'MarcoLogicoController@frecuencia_medicion')->name('frecuencia_medicion');
        //indicadores
        Route::apiResource('indicadores', IndicadoresController::class);
        Route::post('indicadores_mod', 'IndicadoresController@indicadores_mod')->name('indicadores_mod'); 
        Route::post('indicador_resultado', 'IndicadoresController@indicador_resultado')->name('indicador_resultado'); 
        
        //planificacion
        Route::apiResource('planificaciones', PlanificacionesController::class);
        Route::post('planificaciones_mod', 'PlanificacionesController@planificaciones_mod')->name('planificaciones_mod');         
        Route::apiResource('programaciones', ProgramacionController::class);
        Route::post('programaciones_mod', 'ProgramacionController@programaciones_mod')->name('programaciones_mod');  
    });     
?>