<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //registro de datos importantes del sistema
            PermissionSeeder::class,
            RolSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            ParammeterSeeder::class,
            //registro de datos del sistema 
            InterventionTypeSeeder::class,
            ClaInstitucionalSeeder::class,
            ClaSectorialSeeder::class,
            ObjetiveTypeSeeder::class,
            //registro de datos base de inicio para usuarios
            PersonaSeeder::class,
            FuncionarioSeeder::class,
            //registro de vinculos de permisos y soles con usuarios
            RolesHasPermissionSeeder::class,
            ModelHasRolesSeeder::class,

            //extras de max
            ClaOrganismosSeeder::class,
            LocationTypeSeeder::class,
            LocalizacionSeeder::class,
            MedicionSeeder::class,
            RegisterTypeSeeder::class,
            //07-11-2021
            DocModulosSeeder::class,
            DocumentTypeSeeder::class,
            //08-11-2021
            MoveFinancialTypeSeeder::class,
            ClaPresupuestarioSeeder::class,

            //23-11-2021
           IntervencionSeeder::class,
           MoveIndicatorTypeSeeder::class,
           IndicadorFrecuenciaSeeder::class,

           // 30-11-2021
           CotizacionDolarSeeder::class,

           // constructor seeders
           UnidadEjecutoraSeederphp::class,

        ]);
    }
}
