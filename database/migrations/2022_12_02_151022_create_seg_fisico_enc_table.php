<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegFisicoEncTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seg_fisico_enc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id'); // es el document id contrato principal o subcontrato  
            $table->unsignedBigInteger('move_indicator_type_id'); // PR EJ MD         
            $table->string('gestion')->nullable();
            $table->string('nombre_programa');
            $table->date('inicio_programa'); // fecha programadas de incio
            $table->date('fin_programa'); // fecha programadas de finalizacion
            $table->integer('numero_mediciones')->default(1); // 
            $table->integer('clase_medicion')->default(1); // 1.- iguales 2.- personalizado
            $table->text('descripcion_programa');

            $table->string('nuri_programa')->nullable(); // relacion con el sistema de correspondencia
            $table->string('path_programa')->nullable();//via + nombre del archivo que se subio.

            $table->timestamps();
            $table->foreign('contrato_id')->references('id')->on('documents');
            $table->foreign('move_indicator_type_id')->references('id')->on('move_indicator_types');

        });
    }

    /**
     *      * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seg_fisico_enc');
    }
}
