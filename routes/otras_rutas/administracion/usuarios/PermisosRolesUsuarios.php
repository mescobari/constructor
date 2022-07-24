<?php
    Route::group(['prefix' => 'usuarios', 'namespace' => 'Back_End\Administracion'], function () {
        /*RUTAS DE USUARIO*/
        Route::post('usuario/actualiza_permisos_ver', 'UsuarioController@actualizar_permisos_ver')->name('actualizar_permisos_usuario_ver')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('usuario/actualiza_roles_ver', 'UsuarioController@actualizar_roles_ver')->name('actualizar_roles_usuario_ver')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('usuario/actualiza_permisos', 'UsuarioController@actualizar_permisos_usuario')->name('actualizar_permisos_usuario')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('usuario/actualiza_roles', 'UsuarioController@actualizar_roles_usuario')->name('actualizar_roles_usuario')->middleware(['auth','usuario_activo','permiso_admin']);
    }); 
?>