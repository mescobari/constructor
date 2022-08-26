<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('objetivo', 'ObjetivosController@inicio')->name('objetivo');  //menu
        Route::apiResource('objetivos', ObjetivosController::class);      
        
        Route::get('tipo_objetivo/{id}', 'ObjetivosController@verTipoObjetivo')->name('tipo_objetivo');
        Route::get('tipos_objetivos', 'ObjetivosController@verTiposObjetivos')->name('tipos_objetivos');
        Route::get('objetivos_proceso/{id}', 'ObjetivosController@verObjetivosProceso')->name('objetivos_proceso');
        Route::get('tipos_objetivos_hijos/{id}', 'ObjetivosController@verTiposObjetivosHijos')->name('tipos_objetivos_hijos');
        Route::get('resultado/{id}', 'ObjetivosController@verResultado')->name('resultado');
        Route::post('modificar_objetivo', 'ObjetivosController@updateObjetivo')->name('modificar_objetivo');
        Route::post('modificar_resultado', 'ObjetivosController@updateResultado')->name('modificar_resultado');
        Route::post('guardar_resultado', 'ObjetivosController@storeResultado')->name('guardar_resultado');    
        Route::get('eliminar_resultado/{id}', 'ObjetivosController@deleteResultado')->name('eliminar_resultado');        
    });     
?>