<?php
    Route::group(['prefix' => 'personas', 'namespace' => 'Back_End\Administracion'], function () {
        /*RUTAS DE persona*/
        Route::get('persona', 'personaController@index')->name('persona')->middleware(['auth','usuario_activo']);
        Route::get('crear', 'personaController@crear')->name('crear_persona')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('persona', 'personaController@guardar')->name('guardar_persona')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('persona/{id}/editar', 'personaController@editar')->name('editar_persona')->middleware(['auth','usuario_activo']);
        Route::post('persona/actualizar', 'personaController@actualizar')->name('actualizar_persona')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::delete('persona/{id}', 'personaController@eliminar')->name('eliminar_persona')->middleware(['auth','usuario_activo','permiso_admin']);
    }); 
?>