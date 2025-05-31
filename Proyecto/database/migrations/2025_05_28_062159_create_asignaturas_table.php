<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->integer('creditos')->nullable();
            $table->unsignedBigInteger('programaId');
            $table->timestamps();

            $table->foreign('programaId')->references('id')->on('programas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};
