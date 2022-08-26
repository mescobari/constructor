<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('ubicacion', 'ubicacionesController@inicio')->name('ubicacion');  //menu
        Route::apiResource('ubicaciones', ubicacionesController::class);
        Route::get('departamentos', 'ubicacionesController@departamentos')->name('departamentos');  //depatamentos
        Route::post('ubicacionesBuscadas', 'ubicacionesController@ubicacionesBuscadas')->name('ubicacionesBuscadas');  //ubicaciones para la tabla de busqueda de ubicaciones        
        Route::post('GuardarUbicaciones', 'ubicacionesController@GuardarUbicaciones')->name('GuardarUbicaciones');
        Route::post('BuscaUbicacionesRegistradas', 'ubicacionesController@BuscaUbicacionesRegistradas')->name('BuscaUbicacionesRegistradas');
        Route::post('eliminar_ubicacion', 'ubicacionesController@eliminar_ubicacion')->name('eliminar_ubicacion');
        
    });     
?>