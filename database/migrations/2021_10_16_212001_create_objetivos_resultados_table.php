<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivosResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivos_resultados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objetivos_id');
            $table->unsignedBigInteger('resultados_id');
            $table->timestamps();
            $table->foreign('objetivos_id')->references('id')->on('objetivos');
            $table->foreign('resultados_id')->references('id')->on('resultados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetivos_resultados');
    }
}
