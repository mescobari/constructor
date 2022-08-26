<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesEjecutorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_ejecutoras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion_id');
            $table->integer('unidad_ejecutora');
            $table->unsignedBigInteger('dir_admin_id');
            $table->string('nombre'); 
            $table->string('palabras_clave')->nullable(); 
            $table->date('fecha_inicial');
            $table->date('fecha_final')->nullable();
            $table->string('estado'); 
            $table->timestamps();

            $table->foreign('institucion_id')->references('id')->on('cla_institucional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades_ejecutoras');
    }
}
