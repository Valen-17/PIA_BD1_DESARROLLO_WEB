@extends('layouts.app')

@section('title', 'Asignar Proyectos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Asignar Proyectos a {{ $evaluador->nombreCompleto }}</h1>

    <form action="{{ route('evaluadores.guardar-proyectos', $evaluador) }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Proyectos</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($proyectos as $proyecto)
                    <div class="flex items-center">
                        <input type="checkbox" name="proyectos[]" value="{{ $proyecto->id }}"
                            {{ in_array($proyecto->id, $asignados) ? 'checked' : '' }}
                            class="mr-2">
                        <span>{{ $proyecto->titulo }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Guardar Asignaciones
        </button>
    </form>
</div>
@endsection