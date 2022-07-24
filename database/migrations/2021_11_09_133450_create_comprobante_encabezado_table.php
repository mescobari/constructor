<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobanteEncabezadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobante_encabezado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervenciones_id');
            $table->date('fecha');
            $table->string('gestion')->nullable();
            $table->unsignedBigInteger('move_finacial_type_id');
            $table->string('concepto');
            $table->string('glosa')->nullable();
            $table->string('pathDocumento');//via + nombre del archivo que se subio.
            $table->timestamps();
            $table->foreign('intervenciones_id')->references('id')->on('intervenciones');
            $table->foreign('move_finacial_type_id')->references('id')->on('move_financial_types');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobante_encabezado');
    }
}
