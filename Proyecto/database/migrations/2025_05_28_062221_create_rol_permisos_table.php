<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rolPermisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rolId');
            $table->unsignedBigInteger('permisoId');
            $table->timestamps();

            // Índice único compuesto para evitar duplicados
            $table->unique(['rolId', 'permisoId']);

            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permisoId')->references('id')->on('permisos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rolPermisos');
    }
};
