<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadorPlanificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicador_planificacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indicadores_resultados_id');// que indicador resultado
            $table->string('gestion');
            $table->date('fecha_inicial');// periodo de observacion del indicador fecha inicial y fecha finañ
            $table->date('fecha_final')->nullable();
            $table->unsignedBigInteger('indicador_frecuencia_id');// frecuencia d ela medicion 
            $table->float('valor_inicial');// linea base valor inicial
            $table->float('valor_final');// valor final, observado al concluir el periodo de obs.
            $table->text('glosa'); // descripcion del registro planificado
            $table->string('pathDocumento');//via + nombre del archivo que se subio.
            $table->timestamps();
            $table->foreign('indicadores_resultados_id')->references('id')->on('indicadores_resultados');
            $table->foreign('indicador_frecuencia_id')->references('id')->on('indicador_frecuencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicador_planificacion');
    }
}
