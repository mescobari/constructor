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
            $table->unsignedBigInteger('documents_id');
            $table->string('tipo'); //G gupo, I item, c costo
            $table->unsignedBigInteger('padre')->nullable();
            $table->string('codigo'); //item codificacion 1.1.
            $table->string('descripcion');
            $table->string('unidad')->nullable();
            $table->float('cantidad',12,2)->nullable();
            $table->float('precio_unitario',12,2)->nullable();
            $table->timestamps();

            $table->foreign('documents_id')->references('id')->on('documents');

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
