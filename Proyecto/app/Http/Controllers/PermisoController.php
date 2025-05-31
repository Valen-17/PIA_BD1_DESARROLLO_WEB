<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PermisoController extends Controller
{
    // Obtener todos los permisos
    public function index(): JsonResponse
    {
        $permisos = Permiso::with('roles')->get();
        return response()->json($permisos);
    }

    // Crear un nuevo permiso
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:permisos,nombre',
            'descripcion' => 'nullable|string|max:255',
            'modulo' => 'required|string|max:100',
        ]);

        $permiso = Permiso::create($request->only([
            'nombre',
            'descripcion',
            'modulo',
        ]));

        return response()->json($permiso, 201);
    }

    // Mostrar un permiso específico
    public function show(Permiso $permiso): JsonResponse
    {
        $permiso->load('roles');
        return response()->json($permiso);
    }

    // Actualizar un permiso
    public function update(Request $request, Permiso $permiso): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:permisos,nombre,' . $permiso->id,
            'descripcion' => 'nullable|string|max:255',
            'modulo' => 'required|string|max:100',
        ]);

        $permiso->update($request->only([
            'nombre',
            'descripcion',
            'modulo',
        ]));

        return response()->json($permiso);
    }

    // Eliminar un permiso
    public function destroy(Permiso $permiso): JsonResponse
    {
        $permiso->delete();
        return response()->json(['message' => 'Permiso eliminado correctamente']);
    }
}
