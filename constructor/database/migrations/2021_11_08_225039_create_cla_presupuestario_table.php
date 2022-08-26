<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaPresupuestarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cla_presupuestario', function (Blueprint $table) {
            $table->id();
            $table->string('codigo'); 
            $table->string('nombre'); 
            $table->unsignedBigInteger('padre')->nullable();
            $table->string('tipo');                      
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
        Schema::dropIfExists('cla_presupuestario');
    }
}
