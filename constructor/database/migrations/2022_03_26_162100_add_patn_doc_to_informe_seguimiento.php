<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatnDocToInformeSeguimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informe_seguimiento', function (Blueprint $table) {
            //
            $table->string('path_doc')->nullable()->after('funcionarios_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informe_seguimiento', function (Blueprint $table) {
            //
            $table->dropColumn('path_doc');
        });
    }
}
