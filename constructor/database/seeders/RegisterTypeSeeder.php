<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('register_types')->insert([
            'nombre' => 'Programacion',
            'sigla' => 'P',
        ]);

        DB::table('register_types')->insert([
            'nombre' => 'Ejecucion',
            'sigla' => 'E',
        ]);
        DB::table('register_types')->insert([
            'nombre' => 'Modificacion',
            'sigla' => 'M',
        ]);

    }
}
