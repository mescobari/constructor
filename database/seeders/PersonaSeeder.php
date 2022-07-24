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
            'ci'=>'7009692',
            'complemento'=>null,
            'expedido'=>7,
            'nombres'=>'Fernando',
            'paterno'=>'Quispe',
            'materno'=>'Castro',
            'direccion'=>'Calle tiahuanacu 1025',
            'telefono'=>null,
            'celular'=>79673216,
            'sexo'=>15,
            'fecha_nacimiento'=>'2021-05-25',
            'codigo_persona'=>'FQC',
        ]);
    }
}
