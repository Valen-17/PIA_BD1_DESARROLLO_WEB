<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docenteAsignaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('docenteId');
            $table->unsignedBigInteger('asignaturaId');
            $table->date('fechaAsignacion')->default(DB::raw('CURRENT_DATE'));
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Índice único compuesto para evitar duplicados
            $table->unique(['docenteId', 'asignaturaId']);

            $table->foreign('docenteId')->references('id')->on('docentes')->onDelete('cascade');
            $table->foreign('asignaturaId')->references('id')->on('asignaturas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docenteAsignaturas');
    }
};
