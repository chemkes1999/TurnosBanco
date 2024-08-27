<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConceptoToTurnosTable extends Migration
{
    public function up()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->string('concepto')->nullable()->after('codigo_turno');
        });
    }

    public function down()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropColumn('concepto');
        });
    }
}
