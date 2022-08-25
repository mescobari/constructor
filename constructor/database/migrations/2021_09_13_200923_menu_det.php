<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuDet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus_det', function (Blueprint $table) {
            $table->id();
            $table->text('id_menu');
            $table->string('nombre')->unique();
            $table->string('descripcion')->unique();
            $table->text('link_url');
            $table->text('id_padre');
            $table->longText('icon_logo');            
            $table->foreignId('id_permission')->references('id')->on('permissions')->onDelete('restrict');
            $table->char('estado', 5);//parametricas 
            $table->foreignId('user_create')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('user_update')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('user_delete')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->text('sql');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus_det');
    }
}
