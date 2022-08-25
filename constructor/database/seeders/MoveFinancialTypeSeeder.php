<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MoveFinancialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('move_financial_types')->insert([
            'nombre' => 'Estructura de Financiamiento',
            'sigla' => 'EF',
        ]);

        DB::table('move_financial_types')->insert([
            'nombre' => 'Monto contratado o comprometido',
            'sigla' => 'CC',
        ]);
        DB::table('move_financial_types')->insert([
            'nombre' => 'inscripción presupuestaria', // tiene que haber una por lo menos en cada gestion
            'sigla' => 'IN',
        ]);
        DB::table('move_financial_types')->insert([
            'nombre' => 'Modificación Presupuestaria',
            'sigla' => 'MD',
        ]);

        DB::table('move_financial_types')->insert([
            'nombre' => 'Ejecución desembolsos',
            'sigla' => 'EJ',
        ]);
        

    }
}
