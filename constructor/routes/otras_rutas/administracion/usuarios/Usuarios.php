<?php
    Route::group(['prefix' => 'usuarios', 'namespace' => 'Back_End\Administracion'], function () {
        /*RUTAS DE USUARIO*/
        Route::get('usuario', 'UsuarioController@index')->name('usuario')->middleware(['auth','usuario_activo']);
        Route::get('crear', 'UsuarioController@crear')->name('crear_usuario')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('usuario', 'UsuarioController@guardar')->name('guardar_usuario')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('usuario/{id}/editar', 'UsuarioController@editar')->name('editar_usuario')->middleware(['auth','usuario_activo']);
        Route::post('usuario/actualizar', 'UsuarioController@actualizar')->name('actualizar_usuario')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::delete('usuario/{id}', 'UsuarioController@eliminar')->name('eliminar_usuario')->middleware(['auth','usuario_activo','permiso_admin']);
    }); 
?>