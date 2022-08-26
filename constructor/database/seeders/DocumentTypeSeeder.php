<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('document_types')->insert([
            'docmodulos_id' => 1,
            'nombre' => 'Resolución de Aprobación',
            'sigla' => 'RES',
            'modifica' => '1,2,3',
            'padre' => '0',
        ]);

        DB::table('document_types')->insert([
            'docmodulos_id' => 2,
            'nombre' => 'Convenio Interinstitucional de Financiamiento',
            'sigla' => 'CIF',
            'modifica' => '1,2,3',
            'padre' => '0',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 2,
            'nombre' => 'Carta Acuerdo',
            'sigla' => 'CAA',
            'modifica' => '1,2,3',
            'padre' => '2',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 2,
            'nombre' => 'Otro docuento modificatorio',
            'sigla' => 'OTR',
            'modifica' => '1,2,3',
            'padre' => '2',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 3,
            'nombre' => 'Contrato',
            'sigla' => 'CNT',
            'modifica' => '1,2,3',
            'padre' => '0',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 3,
            'nombre' => 'Adenda',
            'sigla' => 'ADA',
            'modifica' => '1',
            'padre' => '3',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 3,
            'nombre' => 'Contrato Modificatorio',
            'sigla' => 'CMO',
            'modifica' => '1,2,3',
            'padre' => '3',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 3,
            'nombre' => 'Otros Contrato',
            'sigla' => 'OCO',
            'modifica' => '1,2,3',
            'padre' => '0',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 4,
            'nombre' => 'Boleta de Garantia Buen Uso de Anticipo',
            'sigla' => 'BGA',
            'modifica' => '1',
            'padre' => '3',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 4,
            'nombre' => 'Poliza de Garantia Buen Uso de Anticipo',
            'sigla' => 'PGA',
            'modifica' => '1',
            'padre' => '3',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 4,
            'nombre' => 'Boleta de Garantia de Cumplimiento de Contrato',
            'sigla' => 'BGC',
            'modifica' => '1',
            'padre' => '3',
        ]);
        DB::table('document_types')->insert([
            'docmodulos_id' => 4,
            'nombre' => 'Poliza de Garantia de Cumplimiento de Contrato',
            'sigla' => 'PGC',
            'modifica' => '1',
            'padre' => '3',
        ]);




    }
}
