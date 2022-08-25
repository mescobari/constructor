<?php
namespace Database\Seeders;

use App\Models\BackEnd\intervenciones\InterventionType;

use Illuminate\Database\Seeder;

class InterventionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        InterventionType::create([
            'nombre' => 'Programa',
        ]);
        InterventionType::create([
            'nombre' => 'Proyecto',
        ]);


    }
}
