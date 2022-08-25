<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaInstitucionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cla_institucional', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable(); 
            $table->string('nombre')->nullable(); 
            $table->string('denominacion')->nullable(); 
            $table->string('sigla')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cla_institucional');
    }
}
