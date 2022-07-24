<?php
    Route::group(['prefix' => 'menus', 'namespace' => 'Back_End\Administracion'], function () {
        Route::get('menu', 'MenuController@index')->name('menu')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('menu/crear', 'MenuController@crear')->name('crear_menu')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('menu', 'MenuController@guardar')->name('guardar_menu')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('menu_actializar', 'MenuController@actualizar')->name('actualizar_menu')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::get('menu/{id}/eliminar', 'MenuController@eliminar')->name('eliminar_menu')->middleware(['auth','usuario_activo','permiso_admin']);
        Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden')->middleware(['auth','usuario_activo','permiso_admin']);
    }); 
?>