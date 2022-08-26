<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\BackEnd\administracion\spatie\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {//los permisos ahora se crean al crear menu asi se hace mas facil
        // //id=1
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_administracion' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Menús de Administración, para el Menú',
        // ]);
        // //id=2
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_permisos' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Permisos, para el Menú',
        // ]);
        // //id=3
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_roles' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Roles, para el Menú',
        // ]);
        // //id=4
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_usuarios' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Usuarios, para el Menú',
        // ]);
        // //id=5
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_menu' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Menús, para el Menú',
        // ]);
        // //id=6
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_intervencion' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Intervención, para el Menú',
        // ]);
        // //id=7
        // DB::table('permissions')->insert([
        //     'name' => 'administracion_crud_intervencion' . '_permiso_menu',
        //     'guard_name' => 'web',
        //     'descripcion' => 'Permiso de Administracion de Creacion, Actualización y eliminación de Intervenciones, para el Menú',
        // ]);
    }
}
