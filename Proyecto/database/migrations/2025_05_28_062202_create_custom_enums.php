<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE estado_asignatura AS ENUM ('matriculado', 'cursando', 'aprobado', 'reprobado', 'retirado')");
        DB::statement("CREATE TYPE estado_proyecto AS ENUM ('planificado', 'en_desarrollo', 'terminado', 'evaluado')");
    }

    public function down(): void
    {
        DB::statement('DROP TYPE IF EXISTS estado_proyecto');
        DB::statement('DROP TYPE IF EXISTS estado_asignatura');
    }
};
