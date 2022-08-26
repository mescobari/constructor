<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LocationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('location_types')->insert([
            'nombre' => 'Departamento',
        ]);

        DB::table('location_types')->insert([
            'nombre' => 'Provincia',
        ]);
        DB::table('location_types')->insert([
            'nombre' => 'Municipio',
        ]);
        DB::table('location_types')->insert([
            'nombre' => 'Comunidad',
        ]);
        DB::table('location_types')->insert([
            'nombre' => 'Localidad',
        ]);


    }
}
