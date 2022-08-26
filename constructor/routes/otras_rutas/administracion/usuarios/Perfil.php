<?php
    Route::group(['prefix' => 'perfiles', 'namespace' => 'Back_End\Administracion'], function () {
        /*RUTAS DE USUARIO*/
        Route::get('/perfil', 'UsuarioController@perfil')->name('perfil')->middleware(['auth']);
    }); 
?>