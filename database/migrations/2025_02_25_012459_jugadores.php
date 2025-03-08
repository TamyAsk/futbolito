<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('futbolistas', function (Blueprint $table) {
            $table->id('pk_futbolistas');
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('apodo', 50)->nullable();
            $table->unsignedBigInteger('fk_equipos');
            $table->unsignedBigInteger('fk_pais');
            $table->integer('numero_camiseta');
            $table->date('fecha_nacimiento');
            $table->string('foto', 150)->nullable();
            $table->integer('asistencias');
            $table->integer('goles');
            $table->integer('partidos_jugados');
            $table->integer('titulos_individual');

            $table->timestamps();   

            $table->foreign('fk_equipos')->references('pk_equipos')->on('equipos');
            $table->foreign('fk_pais')->references('pk_pais')->on('pais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
