<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudianteAsignaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudianteId');
            $table->unsignedBigInteger('asignaturaId');
            $table->string('semestre', 10);
            $table->integer('año');
            $table->string('grupo', 10)->nullable();
            $table->decimal('notaFinal', 3, 2)->nullable();
            $table->date('fechaMatricula')->default(DB::raw('CURRENT_DATE'));
            $table->enum('estado', ['matriculado', 'aprobado', 'reprobado', 'retirado'])->default('matriculado');
            $table->timestamps();

            // Índice único compuesto para evitar duplicados por semestre/año
            $table->unique(['estudianteId', 'asignaturaId', 'semestre', 'año']);

            $table->foreign('estudianteId')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->foreign('asignaturaId')->references('id')->on('asignaturas')->onDelete('cascade');
        });

        // Agregar columna con tipo ENUM
        // DB::statement("ALTER TABLE estudiante_asignaturas ADD COLUMN estado estado_asignatura DEFAULT 'matriculado'");
    }

    public function down(): void
    {
        Schema::dropIfExists('estudianteAsignaturas');
    }
};
