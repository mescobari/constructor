<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //registro de ususarios base del sistema
        DB::table('users')->insert([
            'userName' => 'ferdy',
            'email' => 'fernandoquispecastro@gmail.com',
            'password' => Hash::make('12345'),
            'estado' => 'ACT',
        ]);
        DB::table('users')->insert([
            'userName' => 'max',
            'email' => 'max@gmail.com',
            'password' => Hash::make('12345'),
            'estado' => 'ACT',
        ]);
        DB::table('users')->insert([
            'userName' => 'carl',
            'email' => 'carl@gmail.com',
            'password' => Hash::make('12345'),
            'estado' => 'ACT',
        ]);
        DB::table('users')->insert([
            'userName' => 'jefe_de_seguimiento',
            'email' => 'jefe_de_seguimiento@gmail.com',
            'password' => Hash::make('12345'),
            'estado' => 'ACT',
        ]);
        DB::table('users')->insert([
            'userName' => 'tecnico_de_monitoreo',
            'email' => 'tecnico_de_monitoreo@gmail.com',
            'password' => Hash::make('12345'),
            'estado' => 'ACT',
        ]);
    }
}
