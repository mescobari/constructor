<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultigestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multigestion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervenciones_id');
            $table->string('gestion');
            $table->integer('continuidad')->nullable();
            $table->unsignedBigInteger('mml_id');
            $table->unsignedBigInteger('poa_id');
            $table->timestamps();
            $table->foreign('intervenciones_id')->references('id')->on('intervenciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multigestion');
    }
}
