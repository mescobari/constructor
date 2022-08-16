<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');// requerimiento pertenece a un contrato principal
            $table->unsignedBigInteger('tipo_requerimiento_id');//  1:mano obra, 2. material, 3.equipo, 4.llav en mano, deberia ser de una tabla
            $table->string('correlativo_requerimiento');
            $table->date('fecha_requerimiento');
            $table->string('nuri_requerimiento')->nullable();
            $table->text('descripcion_requerimiento');
            $table->text('trabajos_encarados');
            $table->text('gastos_generales');
            $table->string('path_requerimientos')->nullable();
            $table->timestamps();
            $table->foreign('document_id')->references('id')->on('documents');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimientos');
    }
}
