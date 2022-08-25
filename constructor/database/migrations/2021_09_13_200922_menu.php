<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //aqui no se elimina mas que ogicamente por eso hay fecha de eliminacion
        Schema::create('menus', function (Blueprint $table) {
            $table->id();//identificador de la tabla (siempre es id)
            $table->string('nombre')->unique();//nombre que aparecera en el menu ejemplo ( reprote grafico)
            $table->string('descripcion')->unique();//debe describir aqui la tematica del menu Ejemplo( reporte grafico //este es reporte grafico del area de finnzas publicas del sector agricola de la zona x)
            $table->text('link_url');//url direccion de ruta de la pagina a la que direcciona
            $table->integer('id_padre')->default(0);//id que representa el antecesor de el presente registro es cero si es un padre y tiene un nuemero entero positivo si es hijo
            $table->longText('icon_logo')->default('fas fa-link')->nullable();//icono logo que aparece en el nombre de menu 
            $table->string('icon_logo_color')->default("0")->nullable();//icono logo que aparece en el nombre de menu 
            $table->foreignId('id_permission')->references('id')->on('permissions')->onDelete('restrict');// ide relacion con permisos
            $table->integer('orden')->default(0);// orden en el que deben aparecer los menus
            $table->char('estado', 5);//parametricas 
            $table->foreignId('user_create')->references('id')->on('users');//id de usuario que creo el registro
            $table->foreignId('user_update')->nullable()->references('id')->on('users');//id del usuario que modifico el registro
            $table->foreignId('user_delete')->nullable()->references('id')->on('users')->nullable();//id del usuario que elimino el registro
            $table->timestamps();//fecha de creacion y modificaion del registro
            $table->softDeletes('deleted_at', 0);//fecha de eliminacion del registro
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
