<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('organismomenu', 'OrganismosController@inicio')->name('organismomenu');  //menu
        Route::apiResource('organismo', OrganismosController::class);
        Route::get('organismos', 'OrganismosController@organismos')->name('organismos');
    });     
?>