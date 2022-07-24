<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('seguimiento_financiero', 'SeguimientoFinancieroController@inicio')->name('seguimiento_financiero');  //menu
        Route::apiResource('seguimiento_financieros', SeguimientoFinancieroController::class);
    });
?>