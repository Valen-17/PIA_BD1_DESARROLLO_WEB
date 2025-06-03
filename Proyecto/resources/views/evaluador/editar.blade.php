@extends('layouts.app')

@section('title', 'Editar Evaluación')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Evaluación</h1>

    <div class="mb-8 p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Resumen del Proyecto</h2>
        <p><strong>Título:</strong> {{ $proyecto->titulo }}</p>
        <p><strong>Tipo de Proyecto:</strong> {{ $proyecto->tipoProyecto->nombre ?? 'N/A' }}</p>
        <p><strong>Descripción:</strong> {{ $proyecto->descripcion ?? 'Sin descripción' }}</p>

        <div class="mt-4">
            <h3 class="text-lg font-semibold text-gray-700">Asignaturas Relacionadas:</h3>
            @forelse($proyecto->proyectoAsignaturas as $asignacion)
                <div class="border-l-4 border-indigo-500 pl-4 mt-3">
                    <p><strong>Asignatura:</strong> {{ $asignacion->asignatura->descripcion ?? 'N/A' }}</p>
                    <p><strong>Docente:</strong> {{ $asignacion->docente->nombreCompleto ?? 'N/A' }}</p> 
                </div>
            @empty
                <p class="text-gray-500 italic">No hay asignaturas registradas para este proyecto.</p>
            @endforelse
        </div>
    </div>

    <form method="POST" action="{{ route('evaluaciones.update', $evaluacion) }}" class="bg-white p-6 shadow rounded-lg">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-semibold text-gray-800 mb-4">Actualizar Criterios (1 a 10)</h2>

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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            @foreach($criterios as $clave => $etiqueta)
                <div>
                    <label for="{{ $clave }}" class="block text-sm font-medium text-gray-700">{{ $etiqueta }}</label>
                    <input type="number" name="{{ $clave }}" id="{{ $clave }}"
                           min="1" max="10" required
                           value="{{ old($clave, $evaluacion->$clave) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            @endforeach
        </div>

        <div class="mb-6">
            <label for="concluciones" class="block text-sm font-medium text-gray-700">Observaciones o Conclusiones</label>
            <textarea name="concluciones" id="concluciones" rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('concluciones', $evaluacion->concluciones) }}</textarea>
        </div>

        <button type="submit"
                class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
            Actualizar Evaluación
        </button>
        <a href="{{ route('evaluador.proyectos') }}"
           class="ml-4 px-6 py-2 bg-gray-500 text-white font-semibold rounded-md hover:bg-gray-600 transition">
            Cancelar
        </a>
        <input type="hidden" name="proyectoId" value="{{ $evaluacion->proyectoId }}">
        <input type="hidden" name="evaluadorId" value="{{ $evaluacion->evaluadorId }}">
    </form>
</div>
@endsection
