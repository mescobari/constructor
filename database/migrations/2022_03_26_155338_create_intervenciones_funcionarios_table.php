<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervencionesFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenciones_funcionarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervenciones_id');
            $table->unsignedBigInteger('funcionarios_id');
            $table->date('fecha_inicial');
            $table->date('fecha_final')->nullable();//si esta vacía quiere decir que es activo y si esta lleno esta desactivado
            $table->text('motivo')->nullable();
            $table->timestamps();// porque dejo de ser responsable del proyecto
            $table->foreign('intervenciones_id')->references('id')->on('intervenciones');
            $table->foreign('funcionarios_id')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidmigration status
     * 
     */
    public function down()
    {
        Schema::dropIfExists('intervenciones_funcionarios');
    }
}
