<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planillas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id');//es un contrato principal o subcontrato
            $table->unsignedBigInteger('tipo_planilla_id');//1.- inicial/principal, 2. modificacion, 3. avance
            $table->date('fecha_planilla');
            $table->string('numero_planilla');
            $table->string('nuri_planilla')->nullable();
            $table->text('referencia');
            $table->string('path_planilla')->nullable();
            //valores de la planillla
            $table->float('total_planilla',12,2)->nullable();
            $table->float('anticipo_planilla',12,2)->nullable();// Anticipo 20% del anticipo solo en avance
            $table->float('retencion_planilla',12,2)->nullable();// retencion 7% del anticipo solo en avance
            // este registro debe estar asociado a un documento si es que es planil principal o modificacion.

            $table->integer('estado_planilla')->default(0);

           
           
            
            
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('documents');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planillas');
    }
}
