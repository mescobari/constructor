<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCofinanciadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cofinanciadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervenciones_id');
            $table->unsignedBigInteger('institucion_id');
            $table->unsignedBigInteger('organismo_id');

            $table->timestamps();
            $table->foreign('intervenciones_id')->references('id')->on('intervenciones');
            $table->foreign('institucion_id')->references('id')->on('cla_institucional');
            $table->foreign('organismo_id')->references('id')->on('cla_organismos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cofinanciadores');
    }
}
