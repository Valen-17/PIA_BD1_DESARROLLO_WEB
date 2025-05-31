@extends('layouts.app')

@section('title', 'Proyectos para Evaluar')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Proyectos para Evaluar</h1>
            <p class="text-gray-600 text-sm mt-1">Selecciona un proyecto para crear una evaluación</p>
        </div>
        <a href="{{ route('evaluaciones.lista') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-list mr-2"></i>Ver Evaluaciones Realizadas
        </a>
    </div> --}}

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
            {{ session('success') }}
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-indigo-600">Lista de Proyectos</h3>
        </div>
        
        <div class="p-6">
            @if($proyectos->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evaluaciones</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promedio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($proyectos as $proyecto)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $proyecto->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $proyecto->titulo }}</div>
                                        @if($proyecto->descripcion)
                                            <div class="text-sm text-gray-500">{{ Str::limit($proyecto->descripcion, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $proyecto->tipoProyecto->nombre ?? 'Sin tipo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $estadoClass = match($proyecto->estado) {
                                                'planificado' => 'bg-yellow-100 text-yellow-800',
                                                'en_desarrollo' => 'bg-blue-100 text-blue-800',
                                                'terminado' => 'bg-green-100 text-green-800',
                                                'evaluado' => 'bg-indigo-100 text-indigo-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $estadoClass }}">
                                            {{ $proyecto->estadoFormateado() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $proyecto->fechaInicio ? $proyecto->fechaInicio->format('d/m/Y') : 'No definida' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $proyecto->evaluaciones->count() }} evaluación(es)
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($proyecto->promedioEvaluacion())
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $proyecto->promedioEvaluacion() }}/10
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-500">Sin evaluar</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('evaluaciones.create', ['proyecto_id' => $proyecto->id]) }}" 
                                               class="inline-flex items-center px-3 py-1 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700 transition">
                                                <i class="fas fa-star mr-1"></i>Evaluar
                                            </a>
                                            
                                            @if($proyecto->evaluaciones->count() > 0)
                                                <button class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition" 
                                                        onclick="openModal('modalEvaluaciones{{ $proyecto->id }}')">
                                                    <i class="fas fa-eye mr-1"></i>Ver
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mb-4">
                        <i class="fas fa-folder-open text-gray-400 text-6xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay proyectos disponibles</h3>
                    <p class="text-gray-500">No se encontraron proyectos para evaluar.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modales para ver evaluaciones -->
@foreach($proyectos as $proyecto)
    @if($proyecto->evaluaciones->count() > 0)
        <div id="modalEvaluaciones{{ $proyecto->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Evaluaciones - {{ $proyecto->titulo }}</h3>
                    <button class="text-gray-400 hover:text-gray-600" onclick="closeModal('modalEvaluaciones{{ $proyecto->id }}')">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="mt-4 max-h-96 overflow-y-auto">
                    @foreach($proyecto->evaluaciones as $evaluacion)
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex justify-between items-center mb-3 pb-2 border-b border-gray-200">
                                <div class="text-sm font-medium text-gray-900">
                                    <strong>Evaluador:</strong> {{ $evaluacion->evaluador->nombreCompleto }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $evaluacion->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @php
                                    $criterios = [
                                        'contenido' => 'Contenido',
                                        'problematizacion' => 'Problematización',
                                        'objetivos' => 'Objetivos',
                                        'metodologia' => 'Metodología',
                                        'resultados' => 'Resultados',
                                        'potencial' => 'Potencial',
                                        'interaccionPublico' => 'Interacción Público',
                                        'creatividad' => 'Creatividad',
                                        'innovacion' => 'Innovación'
                                    ];
                                @endphp
                                @foreach($criterios as $campo => $nombre)
                                    @if($evaluacion->$campo)
                                        <div class="text-sm">
                                            <div class="text-gray-600">{{ $nombre }}:</div>
                                            <div class="font-semibold text-gray-900">{{ $evaluacion->$campo }}/10</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                            @if($evaluacion->concluciones)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="text-sm text-gray-600 mb-1">Conclusiones:</div>
                                    <p class="text-sm text-gray-900">{{ $evaluacion->concluciones }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endforeach

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Cerrar modal al hacer clic fuera de él
document.addEventListener('click', function(event) {
    const modals = document.querySelectorAll('[id^="modalEvaluaciones"]');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script>
@endsection