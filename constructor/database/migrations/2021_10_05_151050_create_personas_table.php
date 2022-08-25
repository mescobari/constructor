<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatepersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->integer('ci')->unique();
            $table->integer('complemento')->nullable();
			$table->integer('expedido')->nullable();
			$table->string('nombres');
			$table->string('paterno');
			$table->string('materno');
			$table->string('direccion');
            $table->integer('telefono')->nullable();
			$table->integer('celular');
			$table->integer('sexo')->nullable();
			$table->date('fecha_nacimiento');
			$table->string('codigo_persona')->unique();
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
        Schema::dropIfExists('personas');
    }
}
