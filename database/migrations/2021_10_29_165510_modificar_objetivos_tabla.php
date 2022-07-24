<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarObjetivosTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('objetivos', function(Blueprint $table){
           
           

            // $table->integer('duracion_dias')
            //     ->after('fecha_final_programada')
            //     ->nullable(); 
            
            // $table->float('monto')
            //     ->after('duracion_dias')
            //     ->nullable(); 
            // $table->boolean('tipo_ejecucion') // true administracion propia, false contratacion a terceros 
            //     ->after('monto')
            //     ->default(true); 
           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('objetivos', function (Blueprint $table) {
            // $table->dropColumn('duracion_dias');
            // $table->dropColumn('monto');
            // $table->dropColumn('tipo_ejecucioncls
            // ');

        });

    }
}
