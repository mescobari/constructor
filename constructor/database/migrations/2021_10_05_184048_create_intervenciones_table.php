<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion_id');
            $table->unsignedBigInteger('inteventiontype_id');
            $table->string('nombre');
            $table->string('codsisin')->nullable();
            $table->unsignedBigInteger('sectorial_id');
            $table->date('fecha_aprobacion');
            $table->date('fecha_inicial_programada')->nullable();
            $table->integer('duracion_dias');
            $table->date('fecha_inicial_real')->nullable();// sino tiene esta fecha no inicio la ejecucin  fisica
            $table->text('descripcion');
            $table->float('monto_aprobado_bs',12,2);
            $table->float('monto_aprobado_dolares',12,2);
            $table->string('path_proyecto')->nullable();
            $table->timestamps();

            $table->foreign('institucion_id')->references('id')->on('cla_institucional');
            $table->foreign('inteventiontype_id')->references('id')->on('intervention_types');
            $table->foreign('sectorial_id')->references('id')->on('cla_sectorial');
//users_id se necesita para saber quien hizo el ultimo cambio

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervenciones');
    }
}
