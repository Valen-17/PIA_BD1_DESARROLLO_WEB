@extends('layouts.app')

@section('title', 'Evaluaciones Realizadas')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Evaluaciones Realizadas</h1>
    </div>

    @foreach($proyectos as $proyecto)
        @if($proyecto->evaluaciones->count() > 0)
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                <div class="bg-indigo-600 text-white px-6 py-4">
                    <h2 class="text-lg font-semibold mb-1">{{ $proyecto->titulo }}</h2>
                    <p class="text-indigo-100 text-sm">{{ $proyecto->tipoProyecto->nombre ?? 'Sin tipo' }}</p>
                </div>
                
                <div class="p-6">
                    @foreach($proyecto->evaluaciones as $evaluacion)
                        <div class="border-b border-gray-200 mb-4 pb-4 last:border-b-0 last:mb-0 last:pb-0">
                            <div class="mb-3">
                                <div class="font-semibold text-gray-900">
                                    Evaluador: {{ $evaluacion->evaluador->nombreCompleto ?? 'Desconocido' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    Fecha: {{ $evaluacion->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <div class="bg-gray-50 rounded-lg divide-y divide-gray-200">
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
                                        @if($evaluacion->$campo !== null)
                                            <div class="flex justify-between items-center px-4 py-3">
                                                <span class="text-sm font-medium text-gray-900">{{ $nombre }}</span>
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $evaluacion->$campo }}/10
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                
                                @if($evaluacion->concluciones)
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <div class="font-semibold text-gray-900 mb-2">Conclusiones:</div>
                                        <p class="text-gray-700 text-sm leading-relaxed">{{ $evaluacion->concluciones }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    @if($proyectos->isEmpty() || $proyectos->every(fn($p) => $p->evaluaciones->isEmpty()))
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-center">
            <div class="flex items-center justify-center">
                <i class="fas fa-info-circle mr-2"></i>
                <span>No hay evaluaciones realizadas.</span>
            </div>
        </div>
    @endif
</div>
@endsection 