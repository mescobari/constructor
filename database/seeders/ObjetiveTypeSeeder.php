<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ObjetiveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('objetive_types')->insert([
            'objetivo' => 'Fin',
            'resultado' => 'Impacto',            
            'padre' => 0,
            'descripcion' => 'El FIN es la solucion al problema de desarrollo. El impacto es el resultado que se obtiene un tiempo después de la finalización del proyecto o programa. Se trata del cambio producido a nivel más alto que puede atribuirse razonablemente de forma causal a una iniciativa de inversión. Consiste en un cambio de estado sostenible entre los beneficiarios.',
        ]);

        DB::table('objetive_types')->insert([
            'objetivo' => 'Proposito',
            'resultado' => 'Efecto',
            'padre' => 1,
            'descripcion' => 'Es el cambio que se obtiene al finalizar el proyecto o iniciativa de inversión. Se distinguen dos tipos de efectos: los inmediatos y los intermedios. Estos están diferenciados por el marco temporal de su aparición. Generalmente los inmediatos están referidos a aumento de capacidades atribuibles directamente a los productos y/o servicios del proyecto y los intermedios están relacionados a cambios de comportamiento que son consecuencia lógica de haber logrado algunos resultados inmediatos, estos tienen un marco temporal mayor.',
       
        ]);
        DB::table('objetive_types')->insert([
            'objetivo' => 'Componente',
            'resultado' => 'Producto',
            'padre' => 2,
            'descripcion' => 'Son entregables, que pueden ser obras, programas, servicios especificos, bines necesarios para lograr el propósito. Resultados visibles y concretos que se obtienen durante la ejecución de la iniciativa o conjunto de acciones y que contribuyen como consecuencia lógica de las mismas a logro del resultado final.',
       
        ]);
       
        DB::table('objetive_types')->insert([
            'objetivo' => 'Actividad',
            'resultado' => 'Insumo',
            'padre' => 3,
            'descripcion' => 'Las Actividades son aquella que tiene que realizar el ejecutor para lograr los componentes. En este nivel lo que se mide es la efectividad y eficiencia de las actividades, ose son indicadores de procesos que miden la eficiencia con que se movilizan “insumos” para generar productos.',
       
        ]);
        DB::table('objetive_types')->insert([
            'objetivo' => 'Tarea',
            'resultado' => 'Insumo Tarea',
            'padre' => 4,
            'descripcion' => 'Subdivisiones de la actividad',
        ]);

    }
}
