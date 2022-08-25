<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('formulacion_poa', 'FormulacionPOAController@inicio')->name('formulacion_poa');  //menu
        Route::apiResource('formulacion_poas', FormulacionPOAController::class);
        Route::post('buscar_formulacion_poas', 'FormulacionPOAController@buscar_formulacion_poas')->name('buscar_formulacion_poas');
        Route::post('formulacion_poas_mod', 'FormulacionPOAController@formulacion_poas_mod')->name('formulacion_poas_mod');     
        Route::get('objetivos_poa/{id}', 'FormulacionPOAController@objetivos_poa')->name('objetivos_poa');  
        Route::post('buscar_arbol_marco_logico_poa', 'FormulacionPOAController@buscar_arbol_marco_logico_poa')->name('buscar_arbol_marco_logico_poa');     
        Route::post('gestiones_poa', 'FormulacionPOAController@gestiones_poa')->name('gestiones_poa');
        Route::post('gestiones_poa_de_intervencion', 'FormulacionPOAController@gestiones_poa_de_intervencion')->name('gestiones_poa_de_intervencion');

        Route::post('objetivos_nuevos_continuidad', 'FormulacionPOAController@objetivos_nuevos_continuidad')->name('objetivos_nuevos_continuidad');
        Route::post('generar_poa', 'FormulacionPOAController@generar_poa')->name('generar_poa');
        Route::post('guardar_objetivos', 'FormulacionPOAController@guardar_objetivos')->name('guardar_objetivos');
        
    });
?>