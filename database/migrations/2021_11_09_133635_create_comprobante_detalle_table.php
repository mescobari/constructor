<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobanteDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobante_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comprobante_encabezado_id');
            $table->unsignedBigInteger('objetivos_id'); // aqui en realidad solo pueden ir componentes pucha y si el componente es por ejecucion propia tambien actividades??
            $table->unsignedBigInteger('cla_presupuestario_id');
            $table->unsignedBigInteger('cofinanciadores_id');
            $table->string('concepto')->nullable();
            $table->float('monto_bs',12,2);
            $table->float('monto_Sus',12,2)->nullable();           
            $table->timestamps();
            $table->foreign('comprobante_encabezado_id')->references('id')->on('comprobante_encabezado');
            $table->foreign('objetivos_id')->references('id')->on('objetivos');
            $table->foreign('cla_presupuestario_id')->references('id')->on('cla_presupuestario');
            $table->foreign('cofinanciadores_id')->references('id')->on('cofinanciadores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobante_detalle');
    }
}
