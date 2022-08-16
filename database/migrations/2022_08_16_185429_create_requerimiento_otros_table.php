<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientoOtrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_otros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requerimiento_id');
            $table->unsignedBigInteger('requerimiento_recurso_id');

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
        Schema::dropIfExists('requerimiento_otros');
    }
}
