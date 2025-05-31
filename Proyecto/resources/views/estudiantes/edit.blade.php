@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Estudiante</h1>
        
        <form action="{{ route('estudiantes.update', $estudiante) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="identificacion" class="block text-sm font-medium text-gray-700 mb-1">Identificación *</label>
                    <input type="text" id="identificacion" name="identificacion" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('identificacion', $estudiante->identificacion) }}"
                           maxlength="20"
                           required>
                    @error('identificacion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="nombres" class="block text-sm font-medium text-gray-700 mb-1">Nombres *</label>
                    <input type="text" id="nombres" name="nombres" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('nombres', $estudiante->nombres) }}"
                           maxlength="100"
                           required>
                    @error('nombres')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('apellidos', $estudiante->apellidos) }}"
                           maxlength="100"
                           required>
                    @error('apellidos')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" id="email" name="email" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('email', $estudiante->email) }}"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('telefono', $estudiante->telefono) }}"
                           maxlength="20">
                    @error('telefono')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="programa_id" class="block text-sm font-medium text-gray-700 mb-1">Programa *</label>
                    <select id="programa_id" name="programa_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <option value="">Seleccione un programa</option>
                        @foreach($programas as $programa)
                        <option value="{{ $programa->id }}" {{ (old('programa_id') ?? $estudiante->programa_id) == $programa->id ? 'selected' : '' }}>
                            {{ $programa->descripcion }} - {{ $programa->departamento->descripcion }} ({{ $programa->departamento->facultad->descripcion }})
                        </option>
                        @endforeach
                    </select>
                    @error('programa_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('estudiantes.index') }}" 
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