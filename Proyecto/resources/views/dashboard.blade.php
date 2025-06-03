@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Bienvenido, {{ Auth::user()->username }}</h1>
        <p class="mt-2 text-gray-600">Gestión completa del sistema de proyectos</p>
    </div>

    @if(Auth::user()->evaluador)
        <!-- SOLO PARA EVALUADORES -->
        <a href="{{ route('evaluador.proyectos') }}" class="bento-card bg-gradient-to-br from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Mis Proyectos Asignados</h3>
                    <p class="text-indigo-100 mt-1">Evaluación de Proyectos</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">Evaluar ahora</span>
            </div>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Tarjeta Usuarios -->
        <a href="{{ route('usuarios.index') }}" class="bento-card bg-gradient-to-br from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Usuarios</h3>
                    <p class="text-indigo-100 mt-1">Gestión de cuentas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">CRUD completo</span>
            </div>
        </a>

        <!-- Tarjeta Proyectos -->
        <a href="{{ route('proyectos.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Proyectos</h3>
                    <p class="text-blue-100 mt-1">PA y PIA</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-project-diagram text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">+10 nuevos</span>
            </div>
        </a>

        <!-- Tarjeta Estudiantes -->
        <a href="{{ route('estudiantes.index') }}" class="bento-card bg-gradient-to-br from-green-500 to-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Estudiantes</h3>
                    <p class="text-green-100 mt-1">Gestión académica</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">120 registrados</span>
            </div>
        </a>

        <!-- Tarjeta Docentes -->
        <a href="{{ route('docentes.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Docentes</h3>
                    <p class="text-amber-100 mt-1">Profesores</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">30 registrados</span>
            </div>
        </a>

        <!-- Tarjeta Evaluaciones -->
        <a href="{{ route('evaluaciones.index') }}" class="bento-card bg-gradient-to-br from-rose-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Evaluaciones</h3>
                    <p class="text-rose-100 mt-1">Calificaciones</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">15 pendientes</span>
            </div>
        </a>

        <!-- Tarjeta Asignaturas -->
        <a href="{{ route('asignaturas.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Asignaturas</h3>
                    <p class="text-violet-100 mt-1">Materias académicas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-book text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">45 registradas</span>
            </div>
        </a>

        <!-- Tarjeta tipo proyectos -->
        <a href="{{ route('tipo-proyectos.index') }}" class="bento-card bg-gradient-to-br from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Tipos de Proyecto</h3>
                    <p class="text-purple-100 mt-1">PA y PIA</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">Categorías</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('instituciones.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Instituciones</h3>
                    <p class="text-purple-100 mt-1">Institutos</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs"># de Instituciones</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('departamentos.index') }}" class="bento-card bg-gradient-to-br from-purple-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Departamentos</h3>
                    <p class="text-purple-100 mt-1">departamentos</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">8 departamentos</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('facultades.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Facultades</h3>
                    <p class="text-purple-100 mt-1">Facultades</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">8 departamentos</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('programas.index') }}" class="bento-card bg-gradient-to-br from-purple-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Programas</h3>
                    <p class="text-purple-100 mt-1">Programas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">Programas</span>
            </div>
        </a>

        <!-- Tarjeta Evaluadores -->
        <a href="{{ route('evaluadores.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Evaluadores</h3>
                    <p class="text-amber-100 mt-1">Evaluadores</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">30 registrados</span>
            </div>
        </a>

    </div>         -
    @else
        <!-- PARA ADMINISTRADORES / OTROS -->
        {{-- Pegas aquí el resto de tus tarjetas existentes, si quieres permitir acceso para otros roles --}}
        
        {{-- @include('dashboard.partials.admin-cards') --}}
    @endif

    {{-- <!-- Grid estilo Bento -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Tarjeta Usuarios -->
        <a href="{{ route('usuarios.index') }}" class="bento-card bg-gradient-to-br from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Usuarios</h3>
                    <p class="text-indigo-100 mt-1">Gestión de cuentas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">CRUD completo</span>
            </div>
        </a>

        <!-- Tarjeta Proyectos -->
        <a href="{{ route('proyectos.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Proyectos</h3>
                    <p class="text-blue-100 mt-1">PA y PIA</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-project-diagram text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">+10 nuevos</span>
            </div>
        </a>

        <!-- Tarjeta Estudiantes -->
        <a href="{{ route('estudiantes.index') }}" class="bento-card bg-gradient-to-br from-green-500 to-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Estudiantes</h3>
                    <p class="text-green-100 mt-1">Gestión académica</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">120 registrados</span>
            </div>
        </a>

        <!-- Tarjeta Docentes -->
        <a href="{{ route('docentes.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Docentes</h3>
                    <p class="text-amber-100 mt-1">Profesores</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">30 registrados</span>
            </div>
        </a>

        <!-- Tarjeta Evaluaciones -->
        <a href="{{ route('evaluaciones.index') }}" class="bento-card bg-gradient-to-br from-rose-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Evaluaciones</h3>
                    <p class="text-rose-100 mt-1">Calificaciones</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">15 pendientes</span>
            </div>
        </a>

        <!-- Tarjeta Asignaturas -->
        <a href="{{ route('asignaturas.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Asignaturas</h3>
                    <p class="text-violet-100 mt-1">Materias académicas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-book text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">45 registradas</span>
            </div>
        </a>

        <!-- Tarjeta tipo proyectos -->
        <a href="{{ route('tipo-proyectos.index') }}" class="bento-card bg-gradient-to-br from-indigo-500 to-purple-600">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Tipos de Proyecto</h3>
                    <p class="text-purple-100 mt-1">PA y PIA</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">Categorías</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('instituciones.index') }}" class="bento-card bg-gradient-to-br from-blue-500 to-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Instituciones</h3>
                    <p class="text-purple-100 mt-1">Institutos</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs"># de Instituciones</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('departamentos.index') }}" class="bento-card bg-gradient-to-br from-purple-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Departamentos</h3>
                    <p class="text-purple-100 mt-1">departamentos</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">8 departamentos</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('facultades.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Facultades</h3>
                    <p class="text-purple-100 mt-1">Facultades</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">8 departamentos</span>
            </div>
        </a>

        <!-- Tarjeta instituciones -->
        <a href="{{ route('programas.index') }}" class="bento-card bg-gradient-to-br from-purple-500 to-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Programas</h3>
                    <p class="text-purple-100 mt-1">Programas</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">Programas</span>
            </div>
        </a>

        <!-- Tarjeta Evaluadores -->
        <a href="{{ route('evaluadores.index') }}" class="bento-card bg-gradient-to-br from-amber-500 to-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Evaluadores</h3>
                    <p class="text-amber-100 mt-1">Evaluadores</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 text-white/80 text-sm">
                <span class="inline-block bg-white/20 px-2 py-1 rounded-full text-xs">30 registrados</span>
            </div>
        </a>

    </div>         --}}
</div>
@endsection