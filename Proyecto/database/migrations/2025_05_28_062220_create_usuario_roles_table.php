<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarioRoles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarioId');
            $table->unsignedBigInteger('rolId');
            $table->timestamp('fechaAsignacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            // Índice único compuesto para evitar duplicados
            $table->unique(['usuarioId', 'rolId']);

            $table->foreign('usuarioId')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('rolId')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarioRoles');
    }
};
