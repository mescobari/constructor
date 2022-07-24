<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCofinanciadorDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cofinanciador_documento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cofinanciadores_id');
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('objetivos_id');
            $table->string('titulo');
            $table->text('objeto');
            $table->text('modifica')->nullable();// modifica plazo monto u otro
            $table->date('fecha_firma');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_vencimiento');
            $table->integer('duracion_dias');
            $table->float('monto_bs',12,2);
            $table->float('monto_Sus',12,2);
            $table->unsignedBigInteger('padre');
            $table->string('firma');// funcionario y cargo del que firma el documento
            $table->string('pathDocumento');//via + nombre del archivo que se subio.
            $table->timestamps();
            $table->foreign('cofinanciadores_id')->references('id')->on('cofinanciadores');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->foreign('objetivos_id')->references('id')->on('objetivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cofinanciador_documento');
    }
}
