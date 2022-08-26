<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParammeterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //registro de parametros del sistema
        //estados
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'ACT',
            'valor' => 'ACTIVO',
            'grupo' => 'Estados',
            'descripcion' => 'Estado de activado para campos de estado o similares',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'DES',
            'valor' => 'DESACTIVADO',
            'grupo' => 'Estados',
            'descripcion' => 'Estado de inactividad o desactivado para campos de estado o similares',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        //respuestas
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'SI',
            'valor' => 'SI',
            'grupo' => 'Respuestas',
            'descripcion' => 'Respuesta de tipo afirmativa',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'NO',
            'valor' => 'NO',
            'grupo' => 'Respuestas',
            'descripcion' => 'Respuesta de tipo negativa',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'TVZ',
            'valor' => 'TALVEZ',
            'grupo' => 'Respuestas',
            'descripcion' => 'Respuesta de tipo no concluyente',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        //estenciones
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'CH',
            'valor' => 'Chuquisaca',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Chuquisaca',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'LP',
            'valor' => 'La Paz',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de La Paz',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'CB',
            'valor' => 'Cochabamba',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Cochabamba',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'OR',
            'valor' => 'Oruro',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Oruro',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'PT',
            'valor' => 'Potosí',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Potosí',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'TJ',
            'valor' => 'Tarija',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Tarija',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'SC',
            'valor' => 'Santa Cruz',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Santa Cruz',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'BE',
            'valor' => 'Beni',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Beni',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'PD',
            'valor' => 'Pando',
            'grupo' => 'extenciones',
            'descripcion' => 'Extencion para CI del departamento de Pando',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'M',
            'valor' => 'Masculino',
            'grupo' => 'Genero',
            'descripcion' => 'Tipo de sexo, Género Masculino',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
        DB::table('parametricas')->insert([
            'id_padre' => 0,
            'codigo' => 'F',
            'valor' => 'Femenino',
            'grupo' => 'Genero',
            'descripcion' => 'Tipo de sexo, Género Femenino',
            'modificable' => 'NO',
            'estado' => 'ACT',
            'user_create' => 1,
        ]);
    }
}
