<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('financiamiento', 'FinanciamientoController@inicio')->name('financiamiento');  //menu
        Route::apiResource('financiamientos', FinanciamientoController::class);
        Route::post('buscar_financiamientos', 'FinanciamientoController@buscar_financiamientos')->name('buscar_financiamientos');
        Route::post('financiamientos_mod', 'FinanciamientoController@financiamientos_mod')->name('financiamientos_mod');   
    });     
?>