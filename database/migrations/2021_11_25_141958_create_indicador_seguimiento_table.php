<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadorSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicador_seguimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indicador_planificacion_id');
            $table->date('fecha');
            $table->string('gestion');
            $table->unsignedBigInteger('move_indicator_type_id');
            $table->string('concepto');
            $table->float('valor_medido');
            $table->string('glosa')->nullable();
            $table->string('pathDocumento')->nullable();//via + nombre del archivo que se subio.
            $table->timestamps();
            $table->foreign('indicador_planificacion_id')->references('id')->on('indicador_planificacion');
            $table->foreign('move_indicator_type_id')->references('id')->on('move_indicator_types');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicador_seguimiento');
    }
}
