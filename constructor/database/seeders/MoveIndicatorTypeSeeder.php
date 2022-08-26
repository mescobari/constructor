<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MoveIndicatorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('move_indicator_types')->insert([
            'nombre' => 'Programacion',
            'sigla' => 'PR',
        ]);

        DB::table('move_indicator_types')->insert([
            'nombre' => 'Ejecucion',
            'sigla' => 'EJ',
        ]);
       
        DB::table('move_indicator_types')->insert([
            'nombre' => 'Modificación',
            'sigla' => 'MD',
        ]);

       

    }
}
