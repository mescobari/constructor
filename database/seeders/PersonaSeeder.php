<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //registro de persona base para el sistema
        $persona = Persona::create([
            'ci'=>'2538022',
            'complemento'=>null,
            'expedido'=>7,
            'nombres'=>'Max',
            'paterno'=>'Escobari',
            'materno'=>'Quiroga',
            'direccion'=>'Av. Muñoz Reyes #2000',
            'telefono'=>null,
            'celular'=>77777607,
            'sexo'=>15,
            'fecha_nacimiento'=>'1966-03-24',
            'codigo_persona'=>'MEQ',
        ]);
    }
}
