<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientoRelacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_relaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requerimiento_id');
            $table->unsignedBigInteger('planilla_item_id');
            $table->float('vigente',12,2)->nullable();
            $table->float('avance',12,2)->nullable();
            $table->float('estimado',12,2)->nullable();
            $table->float('precio_unitario',12,2)->nullable();
            $table->timestamps();
            $table->foreign('requerimiento_id')->references('id')->on('requerimientos');
            $table->foreign('planilla_item_id')->references('id')->on('planilla_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimiento_relaciones');
    }
}
