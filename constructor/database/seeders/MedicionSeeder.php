<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MedicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('mediciones')->insert([
            'nombre' => 'Linea Base'
        ]);

        DB::table('mediciones')->insert([
            'nombre' => 'Eval. Medio Termino'
        ]);
        DB::table('mediciones')->insert([
            'nombre' => 'Evaluacion Ex-Post'
        ]);
        DB::table('mediciones')->insert([
            'nombre' => 'Evaluacion Periodica'
        ]);

    }
}
