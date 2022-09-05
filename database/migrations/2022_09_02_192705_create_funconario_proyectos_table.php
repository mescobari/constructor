<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunconarioProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_proyectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('unidad_ejecutora_id');
            $table->unsignedBigInteger('documents_id');
            $table->date('fecha_inicial');
            $table->date('fecha_final')->nullable();
            $table->text('motivo')->nullable();

            $table->timestamps();
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->foreign('unidad_ejecutora_id')->references('id')->on('unidades_ejecutoras');
            $table->foreign('documents_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funconario_proyectos');
    }
}
