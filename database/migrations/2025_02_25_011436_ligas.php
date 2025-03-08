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
        Schema::create('ligas', function (Blueprint $table) {
            $table->id('pk_ligas');
            $table->string('nombre');
            $table->string('logo_ligas',150);
            $table->unsignedBigInteger('fk_pais');
            $table->timestamps();

            $table->foreign('fk_pais')->references('pk_pais')->on('pais');
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
