<?php


namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IntervencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'Gestión sustentable de ecosistemas del bosque amazónico por las comunidades indígenas y locales para generar múltiples beneficios ambientales y ',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of   ',  
            'monto_aprobado_bs'=>36001002.23,   
            'monto_aprobado_dolares'=>1100010002.27, 
            'path_proyecto'=>'348_dcumento del proyecto',

        ]);

        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 1,
            'nombre'=> 'Plan Nacional de Cuencas',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2006-11-02',  
            'fecha_inicial_programada'=>'2019-11-02',  
            'duracion_dias'=>5000,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Vice ministerio de recursos hidricos y riego: El Plan Nacional Cuencas es la denominación con la cual se identifican el conjunto de lineamientos y acciones de la política pública de cuencas en Bolivia, iniciada durante el Gobierno del Presidente Evo Morales Ayma (2006-2019). El proceso de desarrollo de la política de gestión de agua y cuencas toma como punto de partida la “guerra del agua” ocurrida durante el año 2000 en la ciudad de Cochabamba; hecho que marcó un hito importante en la construcción de la institucionalidad hídrica en Bolivia. Con la presentación de la primera versión del Plan Nacional de Cuenca en el año 2006, (PNC1) como política pública de Gestión Integrada de Recursos Hídricos y Manejo Integral de Cuencas (GIRH/MIC), se enfatiza la importancia del fortalecimiento del rol del Estado Boliviano frente a la gestión de los recursos naturales. Con la segunda versión del Plan Nacional de Cuencas, formulada durante el 2013, este se consolida como política del Estado Plurinacional de Bolivia.',  
            'monto_aprobado_bs'=>22000000.23,   
            'monto_aprobado_dolares'=>3343420, 
            'path_proyecto'=>'348_dcumento del proyecto2',

        ]);
        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'Programa Nacional de Forestacion y Reforestacion',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Fondo Nacional de Desarrollo Forestal',  
            'monto_aprobado_bs'=>98000000,   
            'monto_aprobado_dolares'=>14000000, 
            'path_proyecto'=>'348_dcumento del proyecto3',

        ]);
        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'Autoridad Plurinacional de la Madre Tierra',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Cooperacion Danesa ',  
            'monto_aprobado_bs'=>36001002.23,   
            'monto_aprobado_dolares'=>1100010002.27, 
            'path_proyecto'=>'348_dcumento del proyecto4',

        ]);

        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'Programa PROINDIGENA ',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Cooperacion Alemana GIZ  ',  
            'monto_aprobado_bs'=>500000,   
            'monto_aprobado_dolares'=>500000, 
            'path_proyecto'=>'348_dcumento del proyecto5',

        ]);
        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'Programa Probosque ',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Cooperacion Alemana GIZ  ',  
            'monto_aprobado_bs'=>2162220,   
            'monto_aprobado_dolares'=>2162220, 
            'path_proyecto'=>'348_dcumento del proyecto6',

        ]);
 
        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'Eliminacion de Malaria ',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'SEDES -  BENI ',  
            'monto_aprobado_bs'=>287746,   
            'monto_aprobado_dolares'=>287746, 
            'path_proyecto'=>'348_dcumento del proyecto7',

        ]);
        DB::table('intervenciones')->insert([
            'institucion_id'=> 196,
            'inteventiontype_id'=> 2,
            'nombre'=> 'PNUD ',        
            'codsisin'=>'0348-00010-0000',   
            'sectorial_id'=>361,  
            'fecha_aprobacion'=>'2021-11-02',  
            'fecha_inicial_programada'=>'2023-11-02',  
            'duracion_dias'=>1110,  
            'fecha_inicial_real'=>'2021-11-02',  
            'descripcion'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of   ',  
            'monto_aprobado_bs'=>100000,   
            'monto_aprobado_dolares'=>100000, 
            'path_proyecto'=>'348_dcumento del proyecto8',

        ]);


    }
}
