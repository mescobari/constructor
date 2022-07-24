<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FrontEnd\usuarios\Funcionario;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vinculo de funcionarios usuarios y personas por defecto con el valor inicial
        $funcionario = Funcionario::create([
            'institucion_id'=>1,
            'persona_id'=>1,
            'users_id'=>1,
            'fecha_inicial'=>'2021-05-25',
            'fecha_final'=>null,
        ]);
        
        $funcionario = Funcionario::create([
            'institucion_id'=>1,
            'persona_id'=>1,
            'users_id'=>2,
            'fecha_inicial'=>'2021-05-25',
            'fecha_final'=>null,
        ]);
        
        $funcionario = Funcionario::create([
            'institucion_id'=>1,
            'persona_id'=>1,
            'users_id'=>3,
            'fecha_inicial'=>'2021-05-25',
            'fecha_final'=>null,
        ]);
        
        $funcionario = Funcionario::create([
            'institucion_id'=>1,
            'persona_id'=>1,
            'users_id'=>4,
            'fecha_inicial'=>'2021-05-25',
            'fecha_final'=>null,
        ]);
        
        $funcionario = Funcionario::create([
            'institucion_id'=>1,
            'persona_id'=>1,
            'users_id'=>5,
            'fecha_inicial'=>'2021-05-25',
            'fecha_final'=>null,
        ]);
    }
}
