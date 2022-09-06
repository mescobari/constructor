<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Constructor'], function () {
        Route::get('responsable', 'ResponsablesController@inicio')->name('responsable');  //menu
        Route::apiResource('responsables', ResponsablesController::class);
        Route::post('buscar_responsables', 'ResponsablesController@buscar_responsables')->name('buscar_responsables');
        Route::post('responsables_mod', 'ResponsablesController@cofinanciadores_mod')->name('responsables_mod');
        Route::get('funcionarios_de_institucion', 'ResponsablesController@funcionarios_de_institucion')->name('funcionarios_de_institucion');
        
    });     
?>