<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyectoId');
            $table->unsignedBigInteger('evaluadorId');
            
            // Campos de evaluación (1-10)
            $table->tinyInteger('contenido')->unsigned()->nullable();
            $table->tinyInteger('problematizacion')->unsigned()->nullable();
            $table->tinyInteger('objetivos')->unsigned()->nullable();
            $table->tinyInteger('metodologia')->unsigned()->nullable();
            $table->tinyInteger('resultados')->unsigned()->nullable();
            $table->tinyInteger('potencial')->unsigned()->nullable();
            $table->tinyInteger('interaccionPublico')->unsigned()->nullable();
            $table->tinyInteger('creatividad')->unsigned()->nullable();
            $table->tinyInteger('innovacion')->unsigned()->nullable();
            $table->text('concluciones')->nullable();
            
            // Puedes añadir más criterios si necesitas los 10 que mencionas
            // (aquí solo puse 8 como ejemplo)
            
           $table->timestamps();

            $table->foreign('proyectoId')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('evaluadorId')->references('id')->on('evaluadores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};