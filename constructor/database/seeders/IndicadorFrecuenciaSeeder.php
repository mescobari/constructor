<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IndicadorFrecuenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Diario',
            'sigla' => 'DI',
            'dias' => '1',
        ]);

        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Semanal',
            'sigla' => 'SE',
            'dias' => '7',
        ]);
        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Quincenal', // tiene que haber una por lo menos en cada gestion
            'sigla' => 'QU',
            'dias' => '15',
        ]);
        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Mensual',
            'sigla' => 'ME',
            'dias' => '30',
        ]);

        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Bimestral',
            'sigla' => 'BI',
            'dias' => '60',
        ]);


        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Trimestral',
            'sigla' => 'TR',
            'dias' => '90',
        ]);

        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Semestral',
            'sigla' => 'SM',
            'dias' => '180',
        ]);

        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Anual',
            'sigla' => 'AN',
            'dias' => '365',
        ]);

        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Medio Termino',
            'sigla' => 'MT',
            'dias' => '0',
        ]);
        DB::table('indicador_frecuencia')->insert([
            'nombre' => 'Ex post',
            'sigla' => 'EP',
            'dias' => '0',
        ]);

    }
}
