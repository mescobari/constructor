<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //asignacion de roles a un usuario
        $user = User::where('id', 1)->first();
        $role = Role::where('id', 1)->first();
        $user->syncRoles([$role->name]);
        $user = User::where('id', 2)->first();
        $role = Role::where('id', 2)->first();
        $user->syncRoles([$role->name]);
        $user = User::where('id', 3)->first();
        $role = Role::where('id', 3)->first();
        $user->syncRoles([$role->name]);
        $user = User::where('id', 4)->first();
        $role = Role::where('id', 4)->first();
        $user->syncRoles([$role->name]);
        $user = User::where('id', 5)->first();
        $role = Role::where('id', 5)->first();
        $user->syncRoles([$role->name]);
    }
}
