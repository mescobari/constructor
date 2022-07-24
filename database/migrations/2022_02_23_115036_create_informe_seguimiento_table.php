<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_seguimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervenciones_id');
            $table->unsignedBigInteger('move_indicator_type_id');
            $table->unsignedBigInteger('document_type_id');
            $table->string('gestion')->nullable();
            $table->date('fecha');
            $table->string('referencia');
            $table->text('descripcion');
            $table->unsignedBigInteger('funcionarios_id');
            $table->timestamps();
            $table->foreign('intervenciones_id')->references('id')->on('intervenciones');
            $table->foreign('move_indicator_type_id')->references('id')->on('move_indicator_types');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->foreign('funcionarios_id')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informe_seguimiento');
    }
}
