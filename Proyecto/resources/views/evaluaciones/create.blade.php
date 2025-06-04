@extends('layouts.app')

{{-- Cambios de diseño --}}

@section('title', 'Crear Evaluación')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Crear Evaluación</h1>
            <p class="text-gray-600 text-sm mt-1">Complete el formulario de evaluación del proyecto</p>
        </div>
        <a href="{{ route('evaluaciones.index') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
    </div>

    <!-- Mensajes de Error -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluaciones.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Contenido Principal -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Información del Proyecto -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-indigo-600">Información del Proyecto</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="proyectoId" class="block text-sm font-medium text-gray-700 mb-2">
                                    Proyecto <span class="text-red-500">*</span>
                                </label>
                                <select name="proyectoId" id="proyectoId" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                        required onchange="mostrarInfoProyecto()">
                                    <option value="">Seleccione un proyecto</option>
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}" 
                                                {{ (isset($proyecto) && $proyecto->id == old('proyectoId', $proyecto->id ?? '')) ? 'selected' : '' }}
                                                data-descripcion="{{ $proyecto->descripcion }}"
                                                data-tipo="{{ $proyecto->tipoProyecto->nombre ?? '' }}"
                                                data-estado="{{ $proyecto->estadoFormateado() }}">
                                            {{ $proyecto->titulo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="evaluadorId" class="block text-sm font-medium text-gray-700 mb-2">
                                    Evaluador <span class="text-red-500">*</span>
                                </label>
                                <select name="evaluadorId" id="evaluadorId" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                                        required>
                                    <option value="">Seleccione un evaluador</option>
                                    @foreach($evaluadores as $evaluador)
                                        <option value="{{ $evaluador->id }}" {{ old('evaluadorId') == $evaluador->id ? 'selected' : '' }}>
                                            {{ $evaluador->nombreCompleto }}
                                            @if($evaluador->especialidad)
                                                - {{ $evaluador->especialidad }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Información adicional del proyecto seleccionado -->
                        <div id="infoProyecto" class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4 hidden">
                            <h6 class="font-semibold text-blue-800 mb-3">Información del Proyecto:</h6>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium text-gray-700">Descripción:</span> <span id="descripcionProyecto" class="text-gray-600"></span></p>
                                <p><span class="font-medium text-gray-700">Tipo:</span> <span id="tipoProyecto" class="text-gray-600"></span></p>
                                <p><span class="font-medium text-gray-700">Estado:</span> <span id="estadoProyecto" class="text-gray-600"></span></p>
                            </div>
                        </div>
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

                <!-- Conclusiones -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-indigo-600">Conclusiones y Observaciones</h3>
                    </div>
                    <div class="p-6">
                        <label for="concluciones" class="block text-sm font-medium text-gray-700 mb-2">
                            Conclusiones
                        </label>
                        <textarea name="concluciones" id="concluciones" rows="5"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Escriba sus conclusiones y observaciones sobre el proyecto...">{{ old('concluciones') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Panel Lateral -->
            <div class="lg:col-span-1">
                <!-- Guía de Evaluación -->
                <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-green-600">
                            <i class="fas fa-info-circle mr-2"></i>Guía de Evaluación
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <h6 class="font-semibold text-gray-800 mb-3">Escala de Calificación:</h6>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="font-medium">9-10:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Excelente</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">7-8:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Bueno</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">5-6:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Regular</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">3-4:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Deficiente</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">1-2:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Muy deficiente</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h6 class="font-semibold text-gray-800 mb-3">Criterios:</h6>
                            <div class="space-y-3 text-xs text-gray-600">
                                <div>
                                    <span class="font-medium text-gray-800">Contenido:</span>
                                    <p>Calidad y profundidad del contenido presentado.</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-800">Problematización:</span>
                                    <p>Claridad en la identificación del problema.</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-800">Objetivos:</span>
                                    <p>Pertinencia y claridad de los objetivos.</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-800">Metodología:</span>
                                    <p>Adecuación de la metodología empleada.</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-800">Resultados:</span>
                                    <p>Coherencia y relevancia de los resultados.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="p-6 space-y-3">
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-save mr-2"></i>Guardar Evaluación
                        </button>
                        <a href="{{ route('evaluaciones.index') }}" 
                           class="w-full flex items-center justify-center px-4 py-3 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                    </div>
                </div>

                <!-- Indicador de Progreso -->
                <div class="bg-white shadow rounded-lg overflow-hidden mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-700">
                            <i class="fas fa-chart-line mr-2"></i>Progreso
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center">
                            <div id="criteriosCompletados" class="text-2xl font-bold text-indigo-600">0/9</div>
                            <div class="text-sm text-gray-500 mt-1">Criterios completados</div>
                            <div class="mt-3">
                                <div class="bg-gray-200 rounded-full h-2">
                                    <div id="barraProgreso" class="bg-indigo-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function mostrarInfoProyecto() {
    const select = document.getElementById('proyectoId');
    const option = select.options[select.selectedIndex];
    const infoDiv = document.getElementById('infoProyecto');
    
    if (option.value) {
        document.getElementById('descripcionProyecto').textContent = option.dataset.descripcion || 'Sin descripción';
        document.getElementById('tipoProyecto').textContent = option.dataset.tipo || 'Sin tipo';
        document.getElementById('estadoProyecto').textContent = option.dataset.estado || 'Sin estado';
        infoDiv.classList.remove('hidden');
    } else {
        infoDiv.classList.add('hidden');
    }
}

function actualizarProgreso() {
    const criterios = ['contenido', 'problematizacion', 'objetivos', 'metodologia', 'resultados', 'potencial', 'interaccionPublico', 'creatividad', 'innovacion'];
    let completados = 0;
    
    criterios.forEach(criterio => {
        const select = document.getElementById(criterio);
        if (select && select.value) {
            completados++;
        }
    });
    
    const porcentaje = (completados / criterios.length) * 100;
    document.getElementById('criteriosCompletados').textContent = `${completados}/${criterios.length}`;
    document.getElementById('barraProgreso').style.width = `${porcentaje}%`;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    mostrarInfoProyecto();
    actualizarProgreso();
    
    // Agregar listeners a todos los selects de criterios
    const criterios = ['contenido', 'problematizacion', 'objetivos', 'metodologia', 'resultados', 'potencial', 'interaccionPublico', 'creatividad', 'innovacion'];
    criterios.forEach(criterio => {
        const select = document.getElementById(criterio);
        if (select) {
            select.addEventListener('change', actualizarProgreso);
        }
    });
});
</script>
@endsection