<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->unsignedBigInteger('facultadId');
            $table->timestamps();

            $table->foreign('facultadId')->references('id')->on('facultades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
