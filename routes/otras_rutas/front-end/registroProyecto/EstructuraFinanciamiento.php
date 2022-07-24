<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('estructura_financiamiento', 'EstructuraFinanciamientoController@inicio')->name('estructura_financiamiento');  //menu
        Route::apiResource('estructura_financiamientos', EstructuraFinanciamientoController::class);
        Route::post('buscar_estructura_financiamientos', 'EstructuraFinanciamientoController@buscar_estructura_financiamientos')->name('buscar_estructura_financiamientos');
        Route::post('estructura_financiamientos_mod', 'EstructuraFinanciamientoController@estructura_financiamientos_mod')->name('estructura_financiamientos_mod');   
       
        Route::get('tipos_movimientos', 'EstructuraFinanciamientoController@tipos_movimientos')->name('tipos_movimientos');   
        Route::get('componenteEF/{id}', 'EstructuraFinanciamientoController@componenteEF')->name('componenteEF');   
        Route::get('partida', 'EstructuraFinanciamientoController@partida')->name('partida');   
        Route::get('cofinanciadorEF/{id}', 'EstructuraFinanciamientoController@cofinanciadorEF')->name('cofinanciador_no_menu');   

        Route::post('comprobante_encabezado_store', 'EstructuraFinanciamientoController@comprobante_encabezado_store')->name('comprobante_encabezado_store'); 
        Route::post('comprobante_detalle_store', 'EstructuraFinanciamientoController@comprobante_detalle_store')->name('comprobante_detalle_store');   
        Route::get('ver_compobante_detalle/{id}', 'EstructuraFinanciamientoController@ver_compobante_detalle')->name('ver_compobante_detalle');   
        Route::post('comprobante_detalle_update', 'EstructuraFinanciamientoController@comprobante_detalle_update')->name('comprobante_detalle_update');

        Route::get('reporte/{id}', 'EstructuraFinanciamientoController@reporte')->name('reporte_estructura_financiamiento');
        
        Route::get('tipo_cambio_bs_sus', 'EstructuraFinanciamientoController@tipo_cambio_bs_sus')->name('tipo_cambio_bs_sus');

        Route::post('comprobante_encabezado_update', 'EstructuraFinanciamientoController@comprobante_encabezado_update')->name('comprobante_encabezado_update');
        Route::post('buscando_encabezado', 'EstructuraFinanciamientoController@buscando_encabezado')->name('buscando_encabezado');
        Route::post('buscar_encabezados', 'EstructuraFinanciamientoController@buscar_encabezados')->name('buscar_encabezados');
        Route::get('editar_desde_encabezado/{id}', 'EstructuraFinanciamientoController@editar_desde_encabezado')->name('editar_desde_encabezado');
        Route::get('eliminar_desde_encabezado/{id}', 'EstructuraFinanciamientoController@eliminar_desde_encabezado')->name('eliminar_desde_encabezado');
        
    });     
?>