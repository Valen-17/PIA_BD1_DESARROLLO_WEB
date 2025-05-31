<?php

use App\Http\Controllers\{ 
    InstitucionController, FacultadController, DepartamentoController, ProgramaController, AsignaturaController,
    DocenteController, EstudianteController, EvaluadorController,
    ProyectoController, TipoProyectoController, EvaluacionController,
    UsuarioController, RolController, PermisoController, ProfileController
};

use Illuminate\Support\Facades\Route;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación de Breeze/Jetstream
require __DIR__.'/auth.php';

// Rutas que requieren autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de recursos - todas agrupadas y con parámetros explícitos para evitar conflictos
    Route::resource('instituciones', InstitucionController::class)->parameters([
        'instituciones' => 'institucion'
    ]);
    
    Route::resource('facultades', FacultadController::class)->parameters([
        'facultades' => 'facultad'
    ]);
    
    Route::resource('departamentos', DepartamentoController::class)->parameters([
        'departamentos' => 'departamento'
    ]);
    
    Route::resource('programas', ProgramaController::class)->parameters([
        'programas' => 'programa'
    ]);
    
    Route::resource('asignaturas', AsignaturaController::class)->parameters([
        'asignaturas' => 'asignatura'
    ]);
    
    Route::resource('docentes', DocenteController::class)->parameters([
        'docentes' => 'docente'
    ]);
    
    Route::resource('estudiantes', EstudianteController::class)->parameters([
        'estudiantes' => 'estudiante'
    ]);
    
    Route::resource('evaluadores', EvaluadorController::class)->parameters([
        'evaluadores' => 'evaluador'
    ]);
    
    Route::resource('tipo-proyectos', TipoProyectoController::class)->parameters([
        'tipo-proyectos' => 'tipoProyecto'
    ]);
    
    Route::resource('proyectos', ProyectoController::class)->parameters([
        'proyectos' => 'proyecto'
    ]);
    
    Route::resource('evaluaciones', EvaluacionController::class)->parameters([
        'evaluaciones' => 'evaluacion'
    ]);
    
    Route::resource('usuarios', UsuarioController::class)->parameters([
        'usuarios' => 'usuario'
    ]);
    
    Route::resource('roles', RolController::class)->parameters([
        'roles' => 'rol'
    ]);
    
    Route::resource('permisos', PermisoController::class)->parameters([
        'permisos' => 'permiso'
    ]);

    Route::get('/evaluaciones/lista', [EvaluacionController::class, 'lista'])
    ->name('evaluaciones.lista');
});