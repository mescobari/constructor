<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable(); //objetivo y descripcion del indicador, que mide?
            //$table->string('frecuencia'); // frecuencia de medicion diaria, semanal, mensual, trimestras, semestral, anual
            $table->unsignedBigInteger('frecuencia');// frecuencia d ela medicion
            $table->text('variables')->nullable(); // variables que interviene en el calculo
            $table->text('calculo')->nullable(); // formula o descripcion del calculo del indicador
            $table->unsignedBigInteger('unidades_id');
            $table->text('medios_verificacion');
            $table->timestamps();
            $table->foreign('frecuencia')->references('id')->on('indicador_frecuencia');
            $table->foreign('unidades_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadores');
    }
}
