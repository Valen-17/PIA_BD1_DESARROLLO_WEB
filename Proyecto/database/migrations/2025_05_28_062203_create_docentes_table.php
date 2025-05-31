<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion', 20)->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('email', 255)->unique();
            $table->string('telefono', 20)->nullable();
            $table->unsignedBigInteger('programaId');
            $table->timestamps();

            $table->foreign('programaId')->references('id')->on('programas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
