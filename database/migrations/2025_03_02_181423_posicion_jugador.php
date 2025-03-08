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
        Schema::create('posicion_futbolistas', function (Blueprint $table) {
            $table->bigIncrements('pk_posicion_futbolistas');
            $table->unsignedBigInteger('fk_posiciones');
            $table->unsignedBigInteger('fk_futbolistas');

            $table->foreign('fk_posiciones')->references('pk_posiciones')->on('posiciones');
            $table->foreign('fk_futbolistas')->references('pk_futbolistas')->on('futbolistas');
            $table->timestamps();
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
