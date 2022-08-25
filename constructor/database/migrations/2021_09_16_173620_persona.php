<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Persona extends Migration
{
    public function up()
    {
        // Schema::create('personas', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('id_padre')->nullable();
        //     $table->string('nombre')->nullable();
        //     $table->string('apellido_primer')->nullable();
        //     $table->string('apellido_segundo')->nullable();
        //     $table->string('apellido_otro')->nullable();
        //     $table->string('direccion')->nullable();
        //     $table->string('celular')->nullable();
        //     $table->string('telefono')->nullable();
        //     $table->string('documento_identidad_numero')->nullable();
        //     $table->string('documento_identidad_complemento')->nullable();
        //     $table->string('documento_identidad_tipo')->nullable();
        //     $table->string('documento_identidad_expedido')->nullable();
        //     $table->string('genero')->nullable();
        //     $table->date('fecha_nacimiento')->nullable();
        //     $table->string('codigo_persona')->unique();
            
        //     $table->char('estado', 5);//parametricas 
        //     $table->foreignId('user_create')->references('id')->on('users')->nullable();//id de usuario que creo el registro
        //     $table->foreignId('user_update')->references('id')->on('users')->nullable();//id del usuario que modifico el registro
        //     $table->foreignId('user_delete')->references('id')->on('users')->nullable();//id del usuario que elimino el registro
        //     $table->timestamps();//fecha de creacion y modificaion del registro
        //     $table->softDeletes('deleted_at', 0)->nullable();//fecha de eliminacion del registro
        // });
    }
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
