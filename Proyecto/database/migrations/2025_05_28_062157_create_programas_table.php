<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->unsignedBigInteger('departamentoId');
            $table->timestamps();

            $table->foreign('departamentoId')->references('id')->on('departamentos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
