<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('cofinanciador', 'CofinanciadoresController@inicio')->name('cofinanciador');  //menu
        Route::apiResource('cofinanciadores', CofinanciadoresController::class);
        Route::post('buscar_cofinanciadores', 'CofinanciadoresController@buscar_cofinanciadores')->name('buscar_cofinanciadores');
        Route::post('cofinanciadores_mod', 'CofinanciadoresController@cofinanciadores_mod')->name('cofinanciadores_mod');
        
    });     
?>