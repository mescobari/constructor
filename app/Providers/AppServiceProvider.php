<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\BackEnd\administracion\menu\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
         View::composer("back-end.layouts.sidebar", function ($view) {
             $menus = Menu::getMenu(true, true);
             $view->with('menusComposer', $menus);
         });
        //adminlte
        View::share('color_tema_asider', 'sidebar-dark-primary');
        // texto
        View::share('clase_color_formularios_cabecera', 'ferdy-background-Primary-blak');
        View::share('sistemas_ferchos', 'SISPRO - APMT');
        View::share('sistemas_ferchos_login', 'LOGIN');
        //colores
        View::share('sistemas_ferchos_color_cabeceras_formulario', 'ferdy-background-Primary-blak');
        View::share('sistemas_ferchos_color_fondo_formulario', 'ferdy-background-form');
        //botones
        View::share('sistemas_ferchos_boton_evento', 'btn-primary');//aceptar ejecutar login
        View::share('sistemas_ferchos_boton_guardar', 'btn-success');//guardar
        View::share('sistemas_ferchos_boton_modificar', 'btn-warning');//modificar
        View::share('sistemas_ferchos_boton_eliminar', 'btn-error');//modificar     
        //desarrollador
        View::share('sistemas_ferchos_nombre_desarrollador', 'Fernando Quispe Castro');
        View::share('sistemas_ferchos_nombre_corporacion', 'Sistema de Seguimieto a Proyectos');
    }
}
