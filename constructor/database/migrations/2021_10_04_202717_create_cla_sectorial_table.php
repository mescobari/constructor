<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaSectorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cla_sectorial', function (Blueprint $table) {
            $table->id();
            $table->string('sector')->nullable(); 
            $table->string('subsector')->nullable(); 
            $table->string('tipo')->nullable();
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
        Schema::dropIfExists('cla_sectorial');
    }
}
