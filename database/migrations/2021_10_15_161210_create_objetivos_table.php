<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     * objetivos igual a la matriz del marco logico
     * @return void
     */
    public function up()
    {
        Schema::create('objetivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervenciones_id');
            $table->unsignedBigInteger('objetivetype_id');
            $table->unsignedBigInteger('padre');
            $table->string('gestion')->nullable();
            $table->string('desc_corta');
            $table->date('fecha_inicial_programada')->nullable();
            $table->date('fecha_final_programada')->nullable();
            $table->integer('duracion_dias');
            $table->float('monto',12,2)->nullable(); 
            $table->boolean('tipo_ejecucion')->default(true);// true administracion propia, false contratacion a terceros
            $table->text('descripcion');
            $table->timestamps();

            $table->foreign('objetivetype_id')->references('id')->on('objetive_types');
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
        Schema::dropIfExists('objetivos');
    }
}
