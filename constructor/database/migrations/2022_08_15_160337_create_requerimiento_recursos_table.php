<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientoRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_recursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_requerimiento_id');//  1:mano obra, 2. material, 3.equipo, 4.llav en mano, deberia ser de una tabla
            $table->string('codigo_recurso');
            $table->string('descripcion_recurso');
            $table->unsignedBigInteger('unidad_id');
            $table->float('precio_referencial',12,2)->nullable();
            $table->string('unidad_contrato')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('requerimiento_recursos');
    }
}
