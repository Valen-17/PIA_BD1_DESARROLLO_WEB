@extends('layouts.app')

@section('title', 'Evaluadores')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Evaluadores</h1>
        <a href="{{ route('evaluadores.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            <i class="fas fa-plus mr-2"></i>Nuevo Evaluador
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Identificación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre Completo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Especialidad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($evaluadores as $evaluador)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $evaluador->identificacion }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $evaluador->nombreCompleto }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $evaluador->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $evaluador->telefono }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $evaluador->especialidad ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('evaluadores.edit', $evaluador) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('evaluadores.destroy', $evaluador) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('¿Estás seguro de eliminar este evaluador?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay evaluadores registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
