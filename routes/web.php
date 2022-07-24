<?php

use Illuminate\Support\Facades\Route;

include_once 'otras_rutas/administracion/Administracion.php';
include_once 'otras_rutas/seguridad/Login.php';

include_once 'otras_rutas/front-end/constructor/Registros.php';

include_once 'otras_rutas/front-end/registroProyecto/Intervencion.php';
include_once 'otras_rutas/front-end/registroProyecto/Instituciones.php';
include_once 'otras_rutas/front-end/registroProyecto/Ubicacion.php';
include_once 'otras_rutas/front-end/registroProyecto/Cofinanciadores.php';
include_once 'otras_rutas/front-end/registroProyecto/Organismos.php';
include_once 'otras_rutas/front-end/registroProyecto/TiposDocumentos.php';
include_once 'otras_rutas/front-end/registroProyecto/MarcoLogico.php';
include_once 'otras_rutas/front-end/registroProyecto/Objetivos.php';
include_once 'otras_rutas/front-end/registroProyecto/EstructuraFinanciamiento.php';
include_once 'otras_rutas/front-end/registroProyecto/DocumentosLegales.php';
include_once 'otras_rutas/front-end/registroProyecto/Responsables.php';

include_once 'otras_rutas/front-end/reporte/Reportes.php';

include_once 'otras_rutas/front-end/planificacionPoa/FormulacionPOA.php';
include_once 'otras_rutas/front-end/planificacionPoa/InscripcionPOA.php';
include_once 'otras_rutas/front-end/seguimiento/Financiero.php';
include_once 'otras_rutas/front-end/seguimiento/Fisico.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/403', ['as' => '403', function() {
    return view('errores.403');
}]);

Route::get('inicio', 'Front_End\InicioController@index')->name('inicio')->middleware(['auth','usuario_activo']);
//Route::get('/', 'Front_End\InicioController@invitado')->name('inicioInvitado');
Route::get('/', [App\Http\Controllers\Front_End\Seguridad\LoginController::class, 'index'])->name('login');
Route::post('login', [App\Http\Controllers\Front_End\Seguridad\LoginController::class, 'login'])->name('login');
  
Route::get('tabla', 'Front_End\InicioController@tabla')->name('tabla');
Route::get('/404', 'Front_End\InicioController@error_404')->name('no_link');
Route::get('/403', 'Front_End\InicioController@error_403')->name('403');
Route::get('/UserInectivate', 'Front_End\InicioController@error_2505')->name('usuario_inactivado');
