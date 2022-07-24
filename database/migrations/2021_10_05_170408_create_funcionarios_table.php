<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//funcionarios === institu_perso_users_role

        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion_id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('users_id');
            // $table->unsignedBigInteger('roles_id');
            $table->date('fecha_inicial');
            $table->date('fecha_final')->nullable();
            
            $table->foreign('institucion_id')->references('id')->on('cla_institucional');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('users_id')->references('id')->on('users');
            // $table->foreign('roles_id')->references('id')->on('roles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
