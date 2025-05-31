@extends('layouts.app')

@section('title', 'Crear Departamento')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nuevo Departamento</h1>
        
        <form action="{{ route('departamentos.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                    <input type="text" id="descripcion" name="descripcion" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="facultadId" class="block text-sm font-medium text-gray-700 mb-1">Facultad *</label>
                    <select id="facultadId" name="facultadId" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <option value="">Seleccione una facultad</option>
                        @foreach($facultades as $facultad)
                        <option value="{{ $facultad->id }}">
                            {{ $facultad->descripcion }} - {{ $facultad->institucion->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('facultadId')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('departamentos.index') }}" 
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
@endsection