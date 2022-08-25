<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarIndicadorSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('indicador_seguimiento', function(Blueprint $table){
           
           

            // $table->integer('duracion_dias')
            //     ->after('fecha_final_programada')
            //     ->nullable(); 
            $table->unsignedBigInteger('informe_seguimiento_id')
            ->after('indicador_planificacion_id')->nullable();
            $table->foreign('informe_seguimiento_id')->references('id')->on('informe_seguimiento');
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
        Schema::table('indicador_seguimiento', function (Blueprint $table) {
             $table->dropColumn('informe_seguimiento_id');
            // $table->dropColumn('monto');
            

        });
    }
}
