<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectoAsignaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyectoId');
            $table->unsignedBigInteger('asignaturaId');
            $table->unsignedBigInteger('docenteId');
            $table->string('grupo', 10)->nullable();
            $table->integer('semestre')->nullable();
            $table->integer('año')->nullable();
            $table->timestamps();

            // Índice único compuesto para evitar duplicados
            $table->unique(['proyectoId', 'asignaturaId']);

            $table->foreign('proyectoId')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('asignaturaId')->references('id')->on('asignaturas')->onDelete('cascade');
            $table->foreign('docenteId')->references('id')->on('docentes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectoAsignaturas');
    }
};
