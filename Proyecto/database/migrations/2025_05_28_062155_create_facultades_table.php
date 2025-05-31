<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facultades', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->unsignedBigInteger('institucionId');
            $table->timestamps();

            $table->foreign('institucionId')->references('id')->on('instituciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facultades');
    }
};
