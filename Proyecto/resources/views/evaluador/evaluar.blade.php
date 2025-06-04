@extends('layouts.app')

@section('title', 'Evaluar Proyecto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Evaluar Proyecto</h1>
            <p class="text-gray-600 text-sm mt-1">Formulario de evaluación del proyecto seleccionado</p>
        </div>
        <a href="{{ route('evaluador.proyectos') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
    </div>

    <form action="{{ route('evaluacion.store', $proyecto->id) }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Columna principal -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Info del Proyecto -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-indigo-600">Resumen del Proyecto</h3>
                    </div>
                    <div class="p-6 text-sm text-gray-700 space-y-2">
                        <p><strong>Título:</strong> {{ $proyecto->titulo }}</p>
                        <p><strong>Tipo:</strong> {{ $proyecto->tipoProyecto->nombre ?? 'N/A' }}</p>
                        <p><strong>Descripción:</strong> {{ $proyecto->descripcion ?? 'Sin descripción' }}</p>
                        <p><strong>Asignaturas - Docente:</strong></p>
                        <ul class="list-disc ml-6">
                            @forelse($proyecto->proyectoAsignaturas as $asignacion)
                                <li>
                                    {{ $asignacion->asignatura->descripcion ?? 'N/A' }} 
                                    - {{ $asignacion->docente->nombreCompleto ?? 'N/A' }}                                    
                                </li>
                            @empty
                                <li class="text-gray-500">No hay asignaturas registradas.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Criterios de Evaluación -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-indigo-600">Criterios de Evaluación (1-10)</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @php
                                $criterios = [
                                    'contenido' => 'Contenido',
                                    'problematizacion' => 'Problematización',
                                    'objetivos' => 'Objetivos',
                                    'metodologia' => 'Metodología',
                                    'resultados' => 'Resultados',
                                    'potencial' => 'Potencial',
                                    'interaccionPublico' => 'Interacción con el Público',
                                    'creatividad' => 'Creatividad',
                                    'innovacion' => 'Innovación'
                                ];
                            @endphp

                            @foreach($criterios as $campo => $nombre)
                                <div>
                                    <label for="{{ $campo }}" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ $nombre }}
                                    </label>
                                    <select name="{{ $campo }}" id="{{ $campo }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Sin calificar</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old($campo) == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-indigo-600">Conclusiones / Observaciones</h3>
                    </div>
                    <div class="p-6">
                        <label for="concluciones" class="block text-sm font-medium text-gray-700 mb-2">
                            Conclusiones
                        </label>
                        <textarea name="concluciones" id="concluciones" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Escribe tus observaciones aquí...">{{ old('concluciones') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Panel lateral -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-green-600">
                            <i class="fas fa-info-circle mr-2"></i>Guía
                        </h3>
                    </div>
                    <div class="p-6 text-sm text-gray-600 space-y-2">
                        <p><strong>9-10:</strong> Excelente</p>
                        <p><strong>7-8:</strong> Bueno</p>
                        <p><strong>5-6:</strong> Regular</p>
                        <p><strong>3-4:</strong> Deficiente</p>
                        <p><strong>1-2:</strong> Muy deficiente</p>
                    </div>
                </div>

                <!-- Botones -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="p-6 space-y-4">
                        <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-save mr-2"></i>Guardar Evaluación
                        </button>
                        <a href="{{ route('dashboard') }}"
                           class="w-full flex items-center justify-center px-4 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
