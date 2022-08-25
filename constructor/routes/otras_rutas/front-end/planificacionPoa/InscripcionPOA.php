<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('inscripcion_poa', 'InscripcionPOAController@inicio')->name('inscripcion_poa');  //menu
        Route::apiResource('inscripcion_poas', InscripcionPOAController::class);
    });
?>