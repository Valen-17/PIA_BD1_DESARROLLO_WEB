@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-700 to-purple-600 text-white rounded-xl p-8 md:p-12 mb-8 shadow-lg">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Gestionador de Proyectos</h1>
        <p class="text-xl md:text-2xl opacity-90">Transformando la docencia a través de proyectos innovadores</p>
    </div>

    <!-- Contenido principal -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 md:p-8 mb-8">
        <!-- Sección 1 -->
        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 border-b-2 border-indigo-200 pb-2 mb-4">
                <i class="fas fa-chalkboard-teacher mr-2"></i>Transformando la Docencia
            </h2>
            <p class="text-lg text-gray-700 leading-relaxed">
                Bienvenidos a la plataforma de inscripción de Proyectos de Aula (PA) y Proyectos Integradores de Aula (PIA)
                para el semestre 2025-01. Este espacio está diseñado para facilitar la recolección de información preliminar
                sobre los proyectos que los docentes implementarán en sus cursos.
            </p>
        </section>

        <!-- Sección 2 -->
        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 border-b-2 border-indigo-200 pb-2 mb-4">
                <i class="fas fa-question-circle mr-2"></i>¿Qué son los proyectos PA Y PIA?
            </h2>
            <p class="text-gray-700 mb-6">
                Los Proyectos de Aula (PA) y Proyectos Integradores de Aula (PIA) son estrategias didácticas y metodológicas activas que buscan enriquecer el proceso de enseñanza-aprendizaje.
            </p>
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold text-indigo-600 mb-3">Metodologías implementadas:</h3>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Aprendizaje Basado en Problemas (ABP)
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Basado en Retos (ABR)
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Aprendizaje Basado en Proyectos (ABPr)
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Aprendizaje Experiencial (AE)
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Juego de Roles
                    </li>
                </ul>
            </div>
        </section>

        <!-- Sección 3 -->
        <section class="mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 border-b-2 border-indigo-200 pb-2 mb-4">
                <i class="fas fa-balance-scale mr-2"></i>¿Qué diferencias tienen?
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Tarjeta PA -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center mb-4">
                        <i class="fas fa-book-open text-indigo-600 text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Proyecto de Aula (PA)</h3>
                    </div>
                    <p class="text-gray-700">
                        Se enfoca en un solo curso y es diseñado por el docente responsable.
                    </p>
                </div>
                
                <!-- Tarjeta PIA -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="text-center mb-4">
                        <i class="fas fa-users text-purple-600 text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Proyecto Integrador de Aula (PIA)</h3>
                    </div>
                    <p class="text-gray-700">
                        Integra dos o más cursos, requiriendo la colaboración entre docentes para su diseño y ejecución.
                    </p>
                </div>
            </div>
        </section>

        <!-- Alerta de fecha límite -->
        <div class="bg-yellow-400 text-gray-900 rounded-lg p-4 text-center font-bold mb-8 shadow-md">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            FECHA LÍMITE DE INSCRIPCIÓN: 23 de Marzo de 2025
        </div>

        <!-- Sección 4 -->
        <section class="bg-gradient-to-r from-indigo-700 to-purple-600 text-white rounded-xl p-8 mb-8 shadow-lg">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                <i class="fas fa-handshake mr-2"></i>Compromiso Institucional
            </h2>
            <p class="text-lg opacity-90">
                La institución reconoce y valora el esfuerzo de los docentes por implementar estas estrategias en sus cursos. Su participación activa es clave para el éxito de esta iniciativa.
            </p>
        </section>

        <!-- Llamado a la acción -->
        <section class="bg-gradient-to-r from-indigo-600 to-purple-500 text-white rounded-xl p-8 text-center shadow-lg">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">
                    <i class="fas fa-rocket mr-2"></i>¡Únete a esta Transformación Educativa!
                </h2>
                <p class="text-lg mb-6 opacity-90">
                    Forma parte de esta iniciativa que busca enriquecer la experiencia educativa
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="bg-white text-indigo-700 hover:bg-gray-100 font-medium px-6 py-3 rounded-lg transition duration-300">
                        <i class="fas fa-user-plus mr-2"></i>Registrarse
                    </a>
                    <a href="{{ route('login') }}" class="bg-indigo-800 hover:bg-indigo-900 text-white font-medium px-6 py-3 rounded-lg transition duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection