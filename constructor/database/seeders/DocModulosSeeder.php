<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DocModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('docmodulos')->insert([
            'nombre' => 'Proyecto/Programa',
            'sigla' => 'INT',
        ]);

        DB::table('docmodulos')->insert([
            'nombre' => 'Convenio Interinstitucional de Financiamiento',
            'sigla' => 'CIF',
        ]);

        DB::table('docmodulos')->insert([
            'nombre' => 'Contrato',
            'sigla' => 'CNT',
        ]);

        DB::table('docmodulos')->insert([
            'nombre' => 'Garantia',
            'sigla' => 'GRT',
        ]);
  

    }
}
