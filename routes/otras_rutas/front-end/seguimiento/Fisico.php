<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('seguimiento_fisico', 'SeguimientoFisicoController@inicio')->name('seguimiento_fisico');  //menu
        Route::apiResource('seguimiento_fisicos', SeguimientoFisicoController::class);
        Route::post('indicadores_seguimiento_fisico', 'IndicadoresController@indicadores_seguimiento_fisico')->name('indicadores_seguimiento_fisico');
        Route::post('storeIndicadorSeguimientoEJ', 'SeguimientoFisicoController@storeIndicadorSeguimientoEJ')->name('storeIndicadorSeguimientoEJ');
        Route::get('editar_seguimiento_fisico/{id}', 'SeguimientoFisicoController@editar_seguimiento_fisico')->name('editar_seguimiento_fisico');
        Route::post('updateIndicadorSeguimientoEJ', 'SeguimientoFisicoController@updateIndicadorSeguimientoEJ')->name('updateIndicadorSeguimientoEJ');
        Route::get('deleteIndicadorSeguimientoEJ/{id}', 'SeguimientoFisicoController@deleteIndicadorSeguimientoEJ')->name('deleteIndicadorSeguimientoEJ');
        
    });
?>