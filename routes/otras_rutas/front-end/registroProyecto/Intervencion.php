<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('intervencion', 'IntervencionesController@inicio')->name('intervencion');  //menu
        Route::apiResource('intervenciones', IntervencionesController::class);
        Route::post('intervenciones_mod', 'IntervencionesController@update')->name('intervenciones_mod');
        Route::get('proyectos', 'IntervencionesController@proyectos')->name('proyectos');
        
        Route::get('intervencion_tipo', 'TipoIntervencionesController@inicio')->name('intervencion_tipo');  
        Route::get('intervencions_tipo', 'TipoIntervencionesController@intervencionesTipoActivas')->name('intervencions_tipo');  
        Route::apiResource('intervenciones_tipo', TipoIntervencionesController::class);
        
        Route::get('sectorial', 'SectorialController@inicio')->name('intervencion_tipo');  
        Route::get('sectorials', 'SectorialController@sectorialesActivas')->name('intervencions_tipo');  
        Route::apiResource('sectoriales', SectorialController::class);

        Route::get('intervenciones_usuario', 'IntervencionesController@intervencionesUsuario')->name('intervenciones_usuario');  
        
    }); 
    
?>