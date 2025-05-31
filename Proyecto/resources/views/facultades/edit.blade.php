@extends('layouts.app')

@section('title', 'Editar Facultad')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Facultad</h1>
        
        <form action="{{ route('facultades.update', $facultad) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="codigo" class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                    <input type="text" id="codigo" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100"
                           value="{{ $facultad->id }}"
                           disabled
                           readonly>    
                    <p class="mt-1 text-xs text-gray-500">El ID no se puede modificar</p>
                </div>
                
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                    <input type="text" id="descripcion" name="descripcion" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('descripcion', $facultad->descripcion) }}"
                           required>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4 md:col-span-2">
                    <label for="institucion_codigo" class="block text-sm font-medium text-gray-700 mb-1">Institución *</label>
                    <select id="institucion_codigo" name="institucion_codigo" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <option value="">Seleccione una institución</option>
                        @foreach($instituciones as $institucion)
                        <option value="{{ $institucion->id }}" 
                                {{ (old('institucion_codigo', $facultad->institucionId) == $institucion->id) ? 'selected' : '' }}>
                            {{ $institucion->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('institucion_codigo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('facultades.index') }}" 
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