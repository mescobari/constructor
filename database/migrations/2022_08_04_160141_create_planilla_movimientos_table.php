<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillaMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_movimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planilla_id');
            $table->unsignedBigInteger('planilla_item_id');
            
            $table->float('cantidad',12,2)->nullable();
            $table->float('precio_unitario',12,2)->nullable();
            $table->timestamps();

            $table->foreign('planilla_item_id')->references('id')->on('planilla_items');
            $table->foreign('planilla_id')->references('id')->on('planillas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planilla_movimientos');
    }
}
