<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\BackEnd\administracion\spatie\Permission;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //registro de permisos y menus vinculados a un permiso
        // //id=1
        // DB::table('menus')->insert([
        //     'nombre' => 'Administración',
        //     'descripcion' => 'Acceso para los Administradores de Sistema',
        //     'link_url' => 'no_link',
        //     'id_padre' => 0,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 1,
        //     'orden' => 0,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        // //id=2
        // DB::table('menus')->insert([
        //     'nombre' => 'Administración de Permisos',
        //     'descripcion' => 'Acceso para los Administradores de Permisos',
        //     'link_url' => 'permiso',
        //     'id_padre' => 1,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 2,
        //     'orden' => 2,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        // //id=3
        // DB::table('menus')->insert([
        //     'nombre' => 'Administración de Roles',
        //     'descripcion' => 'Acceso para los Administradores de Roles',
        //     'link_url' => 'rol',
        //     'id_padre' => 1,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 3,
        //     'orden' => 3,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        // //id=4
        // DB::table('menus')->insert([
        //     'nombre' => 'Administración de Usuarios',
        //     'descripcion' => 'Acceso para los Administradores de Usuarios',
        //     'link_url' => 'usuario',
        //     'id_padre' => 1,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 4,
        //     'orden' => 4,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        // //id=5
        // DB::table('menus')->insert([
        //     'nombre' => 'Administración de Menús',
        //     'descripcion' => 'Acceso para los Administradores de Menús',
        //     'link_url' => 'menu',
        //     'id_padre' => 1,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 5,
        //     'orden' => 1,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        // //id=6
        // DB::table('menus')->insert([
        //     'nombre' => 'Administración de Intervenciones',
        //     'descripcion' => 'Acceso para los Administradores de las diferentes páginas',
        //     'link_url' => 'menu',
        //     'id_padre' => 0,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 6,
        //     'orden' => 5,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        // //id=7
        // DB::table('menus')->insert([
        //     'nombre' => 'Intervenciones',
        //     'descripcion' => 'Creación, Actualización y Eliminacion de registros de Intervenciones',
        //     'link_url' => 'intervencion',
        //     'id_padre' => 6,
        //     'icon_logo' => 'fas fa-align-left',
        //     'icon_logo_color' => '0',
        //     'id_permission' => 7,
        //     'orden' => 6,
        //     'estado' => 'ACT',
        //     'user_create' => 1,
        // ]);
        $datos = [
            '1'=>['nombre'=>'Administración', 'descripcion'=>'Acceso para los Administradores de Sistema', 'link_url'=>'no_link', 'id_padre'=>0, 'icon_logo'=>'fas fa-align-left', 'icon_logo_color'=>'', 'id_permission'=>1, 'orden'=>1, 'estado'=>'ACT', 'user_create'=>1],
            '2'=>['nombre'=>'Administración de Permisos', 'descripcion'=>'Acceso para los Administradores de Permisos', 'link_url'=>'permiso', 'id_padre'=>1, 'icon_logo'=>'fas fa-bars', 'icon_logo_color'=>'', 'id_permission'=>2, 'orden'=>2, 'estado'=>'ACT', 'user_create'=>1],
            '3'=>['nombre'=>'Administración de Roles', 'descripcion'=>'Acceso para los Administradores de Roles', 'link_url'=>'rol', 'id_padre'=>1, 'icon_logo'=>'fas fa-bars', 'icon_logo_color'=>'', 'id_permission'=>3, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],
            '4'=>['nombre'=>'Administración de Usuarios', 'descripcion'=>'Acceso para los Administradores de Usuarios', 'link_url'=>'usuario', 'id_padre'=>1, 'icon_logo'=>'fas fa-bars', 'icon_logo_color'=>'', 'id_permission'=>4, 'orden'=>4, 'estado'=>'ACT', 'user_create'=>1],
            '5'=>['nombre'=>'Administración de Menús', 'descripcion'=>'Acceso para los Administradores de Menús', 'link_url'=>'menu', 'id_padre'=>1, 'icon_logo'=>'fas fa-bars', 'icon_logo_color'=>'', 'id_permission'=>5, 'orden'=>1, 'estado'=>'ACT', 'user_create'=>1],
            '6'=>['nombre'=>'Registro de Programas/proyectos', 'descripcion'=>'Acceso para los Administradores de las diferentes ...', 'link_url'=>'menu', 'id_padre'=>0, 'icon_logo'=>'fas fa-chart-bar', 'icon_logo_color'=>'', 'id_permission'=>6, 'orden'=>2, 'estado'=>'ACT', 'user_create'=>1],
            '7'=>['nombre'=>'Identificación', 'descripcion'=>'Creación, Actualización y Eliminacion de registros...', 'link_url'=>'no_link', 'id_padre'=>6, 'icon_logo'=>'fas fa-fingerprint', 'icon_logo_color'=>'0', 'id_permission'=>7, 'orden'=>1, 'estado'=>'DES', 'user_create'=>1],
            '8'=>['nombre'=>'Marco Logico', 'descripcion'=>'sdfsdfdsfdsfdsf', 'link_url'=>'marco_logico', 'id_padre'=>6, 'icon_logo'=>'fas fa-project-diagram', 'icon_logo_color'=>'text-warning', 'id_permission'=>8, 'orden'=>7, 'estado'=>'ACT', 'user_create'=>1],
            '9'=>['nombre'=>'Indicadores', 'descripcion'=>'Gestión de indicadores', 'link_url'=>'no_link', 'id_padre'=>0, 'icon_logo'=>'fas fa-tachometer-alt', 'icon_logo_color'=>'', 'id_permission'=>9, 'orden'=>6, 'estado'=>'ACT', 'user_create'=>1],
            '10'=>['nombre'=>'Datos Generales', 'descripcion'=>'Son los datos de identificación del proyecto sgp 1...', 'link_url'=>'intervencion', 'id_padre'=>6, 'icon_logo'=>'fas fa-database', 'icon_logo_color'=>'text-warning', 'id_permission'=>10, 'orden'=>2, 'estado'=>'ACT', 'user_create'=>1],
            '11'=>['nombre'=>'Ubicacion', 'descripcion'=>'Donde se encuentra emplazado el proyecto y poblaci...', 'link_url'=>'ubicacion', 'id_padre'=>6, 'icon_logo'=>'fas fa-map-marker-alt', 'icon_logo_color'=>'text-warning', 'id_permission'=>11, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],
            '12'=>['nombre'=>'Fin', 'descripcion'=>'Registra el fin y el impacto que se espera lograr ...', 'link_url'=>'cofinanciador', 'id_padre'=>6, 'icon_logo'=>'fas fa-bullseye', 'icon_logo_color'=>'text-warning', 'id_permission'=>12, 'orden'=>5, 'estado'=>'DES', 'user_create'=>1],
            '13'=>['nombre'=>'Proposito', 'descripcion'=>'Se registran el proposito y los efectos', 'link_url'=>'no_link', 'id_padre'=>6, 'icon_logo'=>'fas fa-dot-circle', 'icon_logo_color'=>'text-warning', 'id_permission'=>13, 'orden'=>6, 'estado'=>'DES', 'user_create'=>1],
            '14'=>['nombre'=>'Estructura Financiamiento', 'descripcion'=>'registro de financiadores partidas y montos proyec...', 'link_url'=>'estructura_financiamiento', 'id_padre'=>6, 'icon_logo'=>'fas fa-file-invoice-dollar', 'icon_logo_color'=>'text-warning', 'id_permission'=>14, 'orden'=>8, 'estado'=>'ACT', 'user_create'=>1],
            '15'=>['nombre'=>'Planificacion POA', 'descripcion'=>'registro poa y su planificación', 'link_url'=>'no_link', 'id_padre'=>0, 'icon_logo'=>'fas fa-briefcase', 'icon_logo_color'=>'', 'id_permission'=>15, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],
            '16'=>['nombre'=>'Seguimiento', 'descripcion'=>'Se registra los valores ejecutados en las tres dim...', 'link_url'=>'no_link', 'id_padre'=>15, 'icon_logo'=>'fas fa-search', 'icon_logo_color'=>'', 'id_permission'=>16, 'orden'=>4, 'estado'=>'ACT', 'user_create'=>1],
            '17'=>['nombre'=>'Fisico', 'descripcion'=>'seguimiento físico de l poa en ejecución', 'link_url'=>'no_link', 'id_padre'=>16, 'icon_logo'=>'fas fa-tools', 'icon_logo_color'=>'', 'id_permission'=>17, 'orden'=>1, 'estado'=>'ACT', 'user_create'=>1],
            '18'=>['nombre'=>'Financiero', 'descripcion'=>'seguimientoa la ejecucion presupuestaria del proye...', 'link_url'=>'no_link', 'id_padre'=>16, 'icon_logo'=>'fas fa-search-dollar', 'icon_logo_color'=>'', 'id_permission'=>18, 'orden'=>2, 'estado'=>'ACT', 'user_create'=>1],
            '19'=>['nombre'=>'Documentos Legales', 'descripcion'=>'gestion de los documentos legales', 'link_url'=>'documentos_legales', 'id_padre'=>6, 'icon_logo'=>'fas fa-gavel', 'icon_logo_color'=>'text-warning', 'id_permission'=>19, 'orden'=>9, 'estado'=>'ACT', 'user_create'=>1],
            '20'=>['nombre'=>'Legal', 'descripcion'=>'seguimiento a plazo y vencimientos documentos lega...', 'link_url'=>'no_link', 'id_padre'=>16, 'icon_logo'=>'fas fa-gavel', 'icon_logo_color'=>'', 'id_permission'=>20, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],
            '21'=>['nombre'=>'Temporal', 'descripcion'=>'plazos', 'link_url'=>'no_link', 'id_padre'=>16, 'icon_logo'=>'far fa-clock', 'icon_logo_color'=>'', 'id_permission'=>21, 'orden'=>4, 'estado'=>'ACT', 'user_create'=>1],
            '22'=>['nombre'=>'Evaluacion', 'descripcion'=>'para medir impacto y efectos', 'link_url'=>'no_link', 'id_padre'=>0, 'icon_logo'=>'fas fa-infinity', 'icon_logo_color'=>'', 'id_permission'=>22, 'orden'=>5, 'estado'=>'ACT', 'user_create'=>1],
            '23'=>['nombre'=>'Formular POA', 'descripcion'=>'Inicializacion y formulacion del poa, se inica la ...', 'link_url'=>'formulacion_poa', 'id_padre'=>15, 'icon_logo'=>'fa fa-fast-forward', 'icon_logo_color'=>'text-danger', 'id_permission'=>23, 'orden'=>1, 'estado'=>'ACT', 'user_create'=>1],
            '24'=>['nombre'=>'Cierre POA', 'descripcion'=>'Permite cerrar calcular saldos y pendientes', 'link_url'=>'no_link', 'id_padre'=>15, 'icon_logo'=>'fa fa-window-close', 'icon_logo_color'=>'text-warning', 'id_permission'=>24, 'orden'=>2, 'estado'=>'ACT', 'user_create'=>1],
            '25'=>['nombre'=>'Monitoreo POA', 'descripcion'=>'permite evaluar el logro y actividades programadas', 'link_url'=>'no_link', 'id_padre'=>15, 'icon_logo'=>'fa fa-eye', 'icon_logo_color'=>'text-success', 'id_permission'=>25, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],
            '26'=>['nombre'=>'Cofinanciadores', 'descripcion'=>'Se registran todas la isntuciones de cofinaciadora...', 'link_url'=>'cofinanciador', 'id_padre'=>6, 'icon_logo'=>'fas fa-chart-bar', 'icon_logo_color'=>'text-warning', 'id_permission'=>26, 'orden'=>4, 'estado'=>'ACT', 'user_create'=>1],
            '27'=>['nombre'=>'Reportes', 'descripcion'=>'Reportes y tblero de control', 'link_url'=>'no_link', 'id_padre'=>0, 'icon_logo'=>'fas fa-folder-open', 'icon_logo_color'=>'text-info', 'id_permission'=>27, 'orden'=>5, 'estado'=>'ACT', 'user_create'=>1],
'28'=>['nombre'=>'Planificación', 'descripcion'=>'reportes de l progrmcion globl ficha proyecto', 'link_url'=>'Reportes', 'id_padre'=>27, 'icon_logo'=>'fas fa-chart-line', 'icon_logo_color'=>'text-info', 'id_permission'=>28, 'orden'=>1, 'estado'=>'ACT', 'user_create'=>1],
'29'=>['nombre'=>'Vigencia Documentos', 'descripcion'=>'plazos y vigencias', 'link_url'=>'Reportes_documentos_legales', 'id_padre'=>27, 'icon_logo'=>'fas fa-bell-slash', 'icon_logo_color'=>'text-success', 'id_permission'=>29, 'orden'=>2, 'estado'=>'ACT', 'user_create'=>1],
'30'=>['nombre'=>'Indicadores Físicos', 'descripcion'=>'avmce fisico del poa', 'link_url'=>'no_link', 'id_padre'=>27, 'icon_logo'=>'fas fa-not-equal', 'icon_logo_color'=>'text-warning', 'id_permission'=>30, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],
'31'=>['nombre'=>'Indicadores financieros', 'descripcion'=>'dfsdfdf', 'link_url'=>'no_link', 'id_padre'=>27, 'icon_logo'=>'fas fa-money-bill-wave', 'icon_logo_color'=>'text-danger', 'id_permission'=>31, 'orden'=>4, 'estado'=>'ACT', 'user_create'=>1],
'32'=>['nombre'=>'Responsables', 'descripcion'=>'asignacion de responsables y maes', 'link_url'=>'responsable', 'id_padre'=>6, 'icon_logo'=>'fas fa-people-arrows', 'icon_logo_color'=>'text-warning', 'id_permission'=>32, 'orden'=>3, 'estado'=>'ACT', 'user_create'=>1],

       
       
        ];
        foreach($datos as $dato){
            $permiso = new Permission;
            $permiso->name = $dato['nombre'] . '_permiso_menu';
            $permiso->guard_name = 'web';
            $permiso->descripcion = 'Permiso de ' . $dato['descripcion'] . ', para el Menú';
            $permiso->save();
            DB::table('menus')->insert([
                'nombre' => $dato['nombre'],
                'descripcion' => $dato['descripcion'],
                'link_url' => $dato['link_url'],
                'id_padre' => $dato['id_padre'],
                'icon_logo' => $dato['icon_logo'],
                'icon_logo_color' => $dato['icon_logo_color'],
                'id_permission' => $permiso->id,
                'orden' => $dato['orden'],
                'estado' => $dato['estado'],
                'user_create' => $dato['user_create'],
            ]);
        }
    }
}
