<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcederOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceder_ordenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->date('fecha_orden_proceder');
            $table->float('anticipo',12,2)->nullable();
            $table->text('desc_orden_proceder');
            $table->string('path_orden_proceder')->nullable();
            $table->timestamps();
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceder_ordenes');
    }
}
