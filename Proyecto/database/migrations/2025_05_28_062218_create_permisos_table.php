<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100)->unique();
            $table->text('descripcion')->nullable();
            $table->string('modulo', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
