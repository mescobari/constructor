<?php

use App\Http\Controllers\Administracion\RolController;

Route::group(['prefix' => 'roles', 'namespace' => 'Back_End\Administracion'], function () {
        Route::get('rol', 'RolController@index')->name('rol')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('rol/crear', 'RolController@crear')->name('crear_rol')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('rol', 'RolController@guardar')->name('guardar_rol')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('rol/{id}/editar', 'RolController@editar')->name('editar_rol')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::put('rol/{id}', 'RolController@actualizar')->name('actualizar_rol')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::delete('rol/{id}', 'RolController@eliminar')->name('eliminar_rol')->middleware(['auth','usuario_activo','permiso_admin']);    

        Route::post('rol-permiso', 'RolController@actualizar_permisos_rol')->name('actualizar_permisos_roles')->middleware(['auth','usuario_activo','permiso_admin']);
    }); 
?>