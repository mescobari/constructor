<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planilla_id');// a que planillas pertenecen los itemes
            $table->unsignedBigInteger('contrato_id');//es un contrato principal o subcontrato
            $table->string('tipo'); //G gupo, I item, c costo
            $table->string('item_codigo')->nullable();
            $table->string('item_descripcion');
            $table->unsignedBigInteger('unidad_id');
            $table->unsignedBigInteger('padre')->nullable();


            $table->timestamps();
            $table->foreign('planilla_id')->references('id')->on('planillas');
            $table->foreign('contrato_id')->references('id')->on('documents');
            $table->foreign('unidad_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planilla_items');
    }
}
