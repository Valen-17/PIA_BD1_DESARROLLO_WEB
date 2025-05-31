# generate_migrations.ps1
Write-Host "Generando migraciones..." -ForegroundColor Green

$commands = @(
    "php artisan make:migration create_instituciones_table",
    "php artisan make:migration create_facultades_table",
    "php artisan make:migration create_departamentos_table",
    "php artisan make:migration create_programas_table", 
    "php artisan make:migration create_asignaturas_table",
    "php artisan make:migration create_tipos_proyecto_table",
    "php artisan make:migration create_custom_enums",
    "php artisan make:migration create_docentes_table",
    "php artisan make:migration create_estudiantes_table",
    "php artisan make:migration create_evaluadores_table",
    "php artisan make:migration create_proyectos_table",
    "php artisan make:migration create_docente_asignaturas_table",
    "php artisan make:migration create_estudiante_asignaturas_table",
    "php artisan make:migration create_proyecto_asignaturas_table",
    "php artisan make:migration create_evaluaciones_table",
    "php artisan make:migration create_usuarios_table",
    "php artisan make:migration create_roles_table",
    "php artisan make:migration create_permisos_table",
    "php artisan make:migration create_usuario_roles_table",
    "php artisan make:migration create_rol_permisos_table"
)

foreach ($cmd in $commands) {
    Write-Host "Ejecutando: $cmd" -ForegroundColor Yellow
    Invoke-Expression $cmd
    Start-Sleep -Seconds 1
}

Write-Host "Migraciones generadas!" -ForegroundColor Green