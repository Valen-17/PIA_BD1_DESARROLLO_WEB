@extends('layouts.app')

@section('title', 'Editar Asignatura')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Asignatura</h1>
        
        <form action="{{ route('asignaturas.update', $asignatura) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción *</label>
                    <input type="text" id="descripcion" name="descripcion" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('descripcion', $asignatura->descripcion) }}"
                           required>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="creditos" class="block text-sm font-medium text-gray-700 mb-1">Créditos</label>
                    <input type="number" id="creditos" name="creditos" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('creditos', $asignatura->creditos) }}">
                    @error('creditos')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4 md:col-span-2">
                    <label for="programaId" class="block text-sm font-medium text-gray-700 mb-1">Programa *</label>
                    <select id="programaId" name="programaId" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <option value="">Seleccione un programa</option>
                        @foreach($programas as $programa)
                        <option value="{{ $programa->id }}" 
                                {{ old('programaId', $asignatura->programaId) == $programa->id ? 'selected' : '' }}>
                            {{ $programa->descripcion }} - {{ $programa->departamento->descripcion }} ({{ $programa->departamento->facultad->descripcion }})
                        </option>
                        @endforeach
                    </select>
                    @error('programaId')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('asignaturas.index') }}" 
                   class="mr-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
