<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requerimiento_id');
            $table->unsignedBigInteger('requerimiento_recurso_id');
            $table->integer('cantidad_recurso');
            $table->integer('horas_recurso')->nullable();
            $table->integer('dias_recurso')->nullable();
            $table->integer('tiempo_total_recurso');// tiempo total del recurso en dias
            $table->float('precio_referencia_recurso',12,2)->nullable();// precio por el tiempo total

            $table->timestamps();
            $table->foreign('requerimiento_id')->references('id')->on('requerimientos');
            $table->foreign('requerimiento_recurso_id')->references('id')->on('requerimiento_recursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimiento_items');
    }
}
