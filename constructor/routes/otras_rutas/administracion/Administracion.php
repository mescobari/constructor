<?php 
    Route::middleware(['auth'])->group(function () {       
        include_once 'usuarios/Usuarios.php'; 
        include_once 'usuarios/Perfil.php'; 
        include_once 'usuarios/Personas.php'; 
        include_once 'usuarios/PermisosRolesUsuarios.php';
        include_once 'menus/Menus.php';
        include_once 'roles/Roles.php';
        include_once 'permissions/Permission.php';
    });
    Route::group(['prefix' => 'admin', 'namespace' => 'Back_End\Administracion'], function () {
        Route::get('', 'AdminController@index');
    }); 
?>