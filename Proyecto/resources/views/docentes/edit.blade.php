@extends('layouts.app')

@section('title', 'Editar Docente')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Docente</h1>

    <form action="{{ route('docentes.update', $docente) }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700">Identificación</label>
            <input type="text" name="identificacion" value="{{ old('identificacion', $docente->identificacion) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('identificacion') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Nombres</label>
            <input type="text" name="nombres" value="{{ old('nombres', $docente->nombres) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('nombres') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Apellidos</label>
            <input type="text" name="apellidos" value="{{ old('apellidos', $docente->apellidos) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('apellidos') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $docente->email) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $docente->telefono) }}" 
                   class="w-full border-gray-300 rounded-lg shadow-sm">
            @error('telefono') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Programa</label>
            <select name="programaId" class="w-full border-gray-300 rounded-lg shadow-sm">
                <option value="">Seleccione</option>
                @foreach($programas as $programa)
                    <option value="{{ $programa->id }}" {{ old('programaId', $docente->programaId) == $programa->id ? 'selected' : '' }}>
                        {{ $programa->descripcion }}
                    </option>
                @endforeach
            </select>
            @error('programaId') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
