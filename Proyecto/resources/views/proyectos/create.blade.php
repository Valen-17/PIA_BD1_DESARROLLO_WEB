@extends('layouts.app')

@section('title', 'Crear Proyecto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nuevo Proyecto</h1>
        
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="tipoProyectoId" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Proyecto *</label>
                <select id="tipoProyectoId" name="tipoProyectoId"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <option value="">Seleccione un tipo</option>
                    @foreach($tiposProyecto as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipoProyectoId') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('tipoProyectoId')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                <input type="text" id="titulo" name="titulo"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                       value="{{ old('titulo') }}" required>
                @error('titulo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="descripcion" name="descripcion"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                          rows="4">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between gap-2">
                <div class="mb-4 w-full">
                    <label for="fechaInicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio</label>
                    <input type="date" id="fechaInicio" name="fechaInicio"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('fechaInicio') }}">
                    @error('fechaInicio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 w-full">
                    <label for="fechaFin" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Fin</label>
                    <input type="date" id="fechaFin" name="fechaFin"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('fechaFin') }}">
                    @error('fechaFin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>            
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Asignaturas y Docentes *</label>

                <div id="asignacionesContainer">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 asignacion-item">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Asignatura</label>
                            <select name="asignaturas[]" class="w-full px-2 py-2 border rounded-md">
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->id }}">{{ $asignatura->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Docente</label>
                            <select name="docentes[]" class="w-full px-2 py-2 border rounded-md">
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}">{{ $docente->nombreCompleto }}</option>
                                @endforeach
                            </select>

                            <button type="button"
                                    class="eliminarAsignacion absolute -top-3 -right-3 bg-red-100 hover:bg-red-200 text-red-600 hover:text-red-700 rounded-full w-6 h-6 flex items-center justify-center shadow"
                                    title="Eliminar asignación">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 8.586L15.293 3.293a1 1 0 011.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd"/>
                                </svg>
                        </button>

                        </div>
                    </div>
                </div>

                <button type="button" id="agregarAsignacion" class="mt-2 px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">
                    + Añadir otra asignatura
                </button>
            </div>


            <div class="flex justify-end mt-6">
                <a href="{{ route('proyectos.index') }}"
                   class="mr-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('agregarAsignacion').addEventListener('click', function () {
        const container = document.getElementById('asignacionesContainer');
        const primeraAsignacion = container.querySelector('.asignacion-item');
        const nuevaAsignacion = primeraAsignacion.cloneNode(true);

        // Limpiar los selects
        nuevaAsignacion.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        container.appendChild(nuevaAsignacion);
    });

    // Delegación de eventos para eliminar filas
    document.getElementById('asignacionesContainer').addEventListener('click', function (e) {
        if (e.target.classList.contains('eliminarAsignacion')) {
            const asignacion = e.target.closest('.asignacion-item');
            const total = document.querySelectorAll('.asignacion-item').length;
            if (total > 1) {
                asignacion.remove();
            } else {
                alert('Debe haber al menos una asignación.');
            }
        }
    });
</script>
@endpush

@endsection
