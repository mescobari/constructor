<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizacionIntervencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacion_intervencion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('localizaciones_id');
            $table->unsignedBigInteger('intervenciones_id');
            $table->timestamps();
            $table->foreign('localizaciones_id')->references('id')->on('localizacion');
            $table->foreign('intervenciones_id')->references('id')->on('intervenciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localizacion_intervencion');
    }
}
