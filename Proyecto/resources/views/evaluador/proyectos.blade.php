@extends('layouts.app')

@section('title', 'Mis Proyectos Asignados')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Proyectos Asignados</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Título Proyecto</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Asignaturas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Docente(s)</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Evaluadores</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase"># Evaluaciones</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Promedio</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse($proyectos as $index => $proyecto)
                        <tr>
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $proyecto->titulo }}</td>

                            {{-- Tipo = Asignaturas --}}
                            <td class="px-6 py-4">
                                @forelse($proyecto->asignaturas as $asignatura)
                                    <span class="block">{{ $asignatura->descripcion }}</span>
                                @empty
                                    <span class="text-gray-500 italic">N/A</span>
                                @endforelse
                            </td>

                            {{-- Docentes asociados --}}
                            <td class="px-6 py-4">
                                @forelse($proyecto->proyectoAsignaturas as $asignacion)
                                    <span class="block">{{ $asignacion->docente->nombreCompleto ?? 'N/A' }}</span>
                                @empty
                                    <span class="text-gray-500 italic">Ninguno</span>
                                @endforelse
                            </td>

                            {{-- Evaluadores asignados --}}
                            <td class="px-6 py-4">
                                @forelse($proyecto->evaluadores as $ev)
                                    <span class="block">{{ $ev->nombreCompleto }}</span>
                                @empty
                                    <span class="text-gray-500 italic">Sin asignar</span>
                                @endforelse
                            </td>

                            {{-- Evaluaciones hechas --}}
                            <td class="px-6 py-4 text-center">{{ $proyecto->evaluaciones->count() }}</td>

                            {{-- Promedio --}}
                            <td class="px-6 py-4 text-center">
                                @php
                                    $prom = $proyecto->promedioEvaluacion();
                                @endphp
                                {{ $prom !== null ? number_format($prom, 2) : 'N/A' }}
                            </td>

                            {{-- Acción de evaluar --}}
                            <td class="px-6 py-4 text-center">
                                @php
                                    $miEvaluacion = $proyecto->evaluaciones->firstWhere('evaluadorId', auth()->user()->evaluador->id ?? null);
                                @endphp

                                @if($miEvaluacion)
                                    <a href="{{ route('evaluacion.formulario', $proyecto->id) }}"
                                    class="inline-block px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600">
                                        Editar Evaluación
                                    </a>
                                @else
                                    <a href="{{ route('evaluacion.formulario', $proyecto->id) }}"
                                    class="inline-block px-3 py-1 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700">
                                        Evaluar
                                    </a>
                                @endif                               
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No hay proyectos asignados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
