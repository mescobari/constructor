<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\BackEnd\administracion\spatie\Permission;

class RolesHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //registro de vinculo de roles y permisos
        $role = Role::where('id', 1)->first();
        $permissions = Permission::all();
        $arrayNameSuperAdmin = [];
        $arrayNameAdmin = [];
        $arrayNameUser = [];
        $cont = 0;
        foreach($permissions as $permission){
            $cont++;
            $arrayNameSuperAdmin = array_merge($arrayNameSuperAdmin, [$permission->name]);
            if($cont > 5){
                $arrayNameUser = array_merge($arrayNameUser, [$permission->name]);
            }else{
                $arrayNameAdmin = array_merge($arrayNameAdmin, [$permission->name]);
            }

        }
        $role->syncPermissions($arrayNameSuperAdmin);
        $role = Role::where('id', 2)->first();
        $role->syncPermissions($arrayNameAdmin);
        $role = Role::where('id', 3)->first();
        $role->syncPermissions($arrayNameUser);
        $role = Role::where('id', 4)->first();
        $role->syncPermissions($arrayNameUser);
        $role = Role::where('id', 5)->first();
        $role->syncPermissions($arrayNameUser);
    }
}
