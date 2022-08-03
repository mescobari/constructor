<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_types_id');
            $table->unsignedBigInteger('unidad_ejecutora_id');
            $table->unsignedBigInteger('padre')->nullable();
            $table->string('nombre');
            $table->string('codigo');
            $table->unsignedBigInteger('contratante_id');
            $table->unsignedBigInteger('contratado_id');
            $table->date('fecha_firma');
            $table->integer('duracion_dias');
            $table->float('monto_bs',12,2);
            $table->text('objeto');
            $table->text('modifica');
            $table->string('path_contrato')->nullable();
            $table->timestamps();

            $table->foreign('document_types_id')->references('id')->on('document_types');
            $table->foreign('unidad_ejecutora_id')->references('id')->on('unidades_ejecutoras');
            $table->foreign('contratante_id')->references('id')->on('cla_institucional');
            $table->foreign('contratado_id')->references('id')->on('cla_institucional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
