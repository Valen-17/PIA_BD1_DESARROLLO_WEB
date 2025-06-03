@extends('layouts.app')

@section('title', 'Evaluar Proyecto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Evaluar Proyecto</h1>

    {{-- Resumen del proyecto --}}
    <div class="mb-8 p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Resumen del Proyecto</h2>

        <p><strong>Título:</strong> {{ $proyecto->titulo }}</p>
        <p><strong>Tipo de Proyecto:</strong> {{ $proyecto->tipoProyecto->nombre ?? 'N/A' }}</p>
        <p><strong>Descripción:</strong> {{ $proyecto->descripcion ?? 'Sin descripción' }}</p>

        <div class="mt-4">
            <h3 class="text-lg font-semibold text-gray-700">Asignaturas Relacionadas:</h3>
            @forelse($proyecto->proyectoAsignaturas as $asignacion)
                <div class="border-l-4 border-indigo-500 pl-4 mt-3">
                    <p><strong>Asignatura:</strong> {{ $asignacion->asignatura->nombre ?? 'N/A' }}</p>
                    <p><strong>Docente:</strong> {{ $asignacion->docente->nombreCompleto ?? 'N/A' }}</p>
                    <p><strong>Grupo:</strong> {{ $asignacion->grupo ?? 'N/A' }}</p>
                    <p><strong>Semestre:</strong> {{ $asignacion->semestre ?? 'N/A' }} | <strong>Año:</strong> {{ $asignacion->año ?? 'N/A' }}</p>
                </div>
            @empty
                <p class="text-gray-500 italic">No hay asignaturas registradas para este proyecto.</p>
            @endforelse
        </div>
    </div>

    {{-- Formulario de evaluación --}}
    <form method="POST" action="{{ route('evaluacion.store', $proyecto->id) }}" class="bg-white p-6 shadow rounded-lg">
        @csrf

        <h2 class="text-lg font-semibold text-gray-800 mb-4">Criterios de Evaluación (1 a 10)</h2>

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
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            @endforeach
        </div>

        {{-- Conclusiones --}}
        <div class="mb-6">
            <label for="concluciones" class="block text-sm font-medium text-gray-700">Observaciones o Conclusiones</label>
            <textarea name="concluciones" id="concluciones" rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                      placeholder="Escribe tus observaciones aquí..."></textarea>
        </div>

        <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
            Guardar Evaluación
        </button>
    </form>
</div>
@endsection
