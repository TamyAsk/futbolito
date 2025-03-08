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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('pk_equipos');
            $table->string('nombre_equipo');
            $table->string('escudo');
            $table->integer('cant_titulos');
            $table->unsignedBigInteger('fk_ligas');
            $table->timestamps();
        
            $table->foreign('fk_ligas')->references('pk_ligas')->on('ligas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
