<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadoresResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores_resultados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resultados_id');
            $table->unsignedBigInteger('indicadores_id');
            $table->timestamps();
            $table->foreign('resultados_id')->references('id')->on('resultados');
            $table->foreign('indicadores_id')->references('id')->on('indicadores');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadores_resultados');
    }
}
