<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //registro de roles base del sistema
        $role = DB::table('roles')->insert([
            'name' => 'super_administrador',
            'guard_name' => 'web',
            'descripcion' => 'Rol Full Administración Proporcionado por el Desarrollador del sistema',
        ]); 
        $role = DB::table('roles')->insert([
            'name' => 'administrador',
            'guard_name' => 'web',
            'descripcion' => 'Rol Administración Proporcionado por el Desarrollador del sistema',
        ]);
        $role = DB::table('roles')->insert([
            'name' => 'usuario',
            'guard_name' => 'web',
            'descripcion' => 'Rol Usuario Proporcionado por el Desarrollador del sistema',
        ]);
        $role = DB::table('roles')->insert([
            'name' => 'jefe_de_seguimiento',
            'guard_name' => 'web',
            'descripcion' => 'Jefe de Seguimiento',
        ]);
        $role = DB::table('roles')->insert([
            'name' => 'tecnico_de_monitoreo',
            'guard_name' => 'web',
            'descripcion' => 'Técnico de Monitoreo',
        ]);
    }
}
