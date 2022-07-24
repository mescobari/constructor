<?php
    Route::group(['prefix' => 'permissions', 'namespace' => 'Back_End\Administracion'], function () {
        Route::post('permiso_ver', 'PermisoController@ver')->name('ver_permisos')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('permiso', 'PermisoController@index')->name('permiso')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('permiso', 'PermisoController@guardar')->name('guardar_permiso')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('permiso/{id}/editar', 'PermisoController@editar')->name('editar_permiso')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::put('permiso/{id}', 'PermisoController@actualizar')->name('actualizar_permiso')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::delete('permiso/{id}', 'PermisoController@eliminar')->name('eliminar_permiso')->middleware(['auth','usuario_activo','permiso_admin']);    
    }); 
?>