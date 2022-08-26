<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userName')->unique();
            $table->string('token')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->default(now());
            $table->string('password')->nullable();
            $table->rememberToken();
            
            $table->char('estado', 5);//parametricas 
            $table->foreignId('user_create')->nullable()->references('id')->on('users');//id de usuario que creo el registro
            $table->foreignId('user_update')->nullable()->references('id')->on('users');//id del usuario que modifico el registro
            $table->foreignId('user_delete')->nullable()->references('id')->on('users');//id del usuario que elimino el registro
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
        Schema::dropIfExists('users');
    }
}
