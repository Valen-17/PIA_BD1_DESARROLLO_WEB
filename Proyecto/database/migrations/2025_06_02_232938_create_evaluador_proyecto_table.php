<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluador_proyecto', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('evaluador_id');
            $table->unsignedBigInteger('proyecto_id');

            $table->timestamps();

            // Relación única para evitar asignaciones duplicadas
            $table->unique(['evaluador_id', 'proyecto_id']);

            $table->foreign('evaluador_id')->references('id')->on('evaluadores')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluador_proyecto');
    }
};
