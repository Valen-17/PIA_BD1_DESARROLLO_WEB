@extends('layouts.app')

@section('title', 'Mis Proyectos Asignados')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mis Proyectos Asignados</h1>
        {{-- Botón opcional para volver al dashboard o futuro exportar --}}
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de Inicio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($proyectos as $proyecto)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $proyecto->titulo }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $proyecto->tipoProyecto->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($proyecto->fechaInicio)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('evaluacion.create', $proyecto->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 font-semibold">
                                    <i class="fas fa-clipboard-check mr-1"></i> Evaluar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                No tienes proyectos asignados actualmente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
