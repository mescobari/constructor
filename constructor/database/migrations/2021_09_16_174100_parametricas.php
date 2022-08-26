<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parametricas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametricas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_padre');
            $table->string('codigo');
            $table->string('valor');            
            $table->string('grupo');
            $table->string('descripcion');
            $table->char('modificable', 2);//si no modificable
            $table->json('json')->nullable();
            
            $table->char('estado', 5);//parametricas 
            $table->foreignId('user_create')->references('id')->on('users');//id de usuario que creo el registro
            $table->foreignId('user_update')->nullable()->references('id')->on('users')->nullable();//id del usuario que modifico el registro
            $table->foreignId('user_delete')->nullable()->references('id')->on('users')->nullable();//id del usuario que elimino el registro
            $table->timestamps();//fecha de creacion y modificaion del registro
            $table->softDeletes('deleted_at', 0)->nullable();//fecha de eliminacion del registro
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametricas');
    }
}
