<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_turno'); // Ejemplo: A001
            $table->string('concepto'); // Cambio de domicilio
            $table->integer('ventanilla')->nullable(); // Ventanilla asignada
            $table->enum('estado', ['pendiente', 'atendiendo', 'completado']); // Estado del turno
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turnos');
    }
}
