<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RolController extends Controller
{
    // Obtener todos los roles con sus relaciones
    public function index(): JsonResponse
    {
        $roles = Rol::with(['usuarios', 'permisos'])->get();
        return response()->json($roles);
    }

    // Crear un nuevo rol
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:roles,nombre',
            'descripcion' => 'nullable|string|max:255'
        ]);

        $rol = Rol::create($request->only(['nombre', 'descripcion']));

        return response()->json($rol, 201);
    }

    // Mostrar un rol específico
    public function show(Rol $rol): JsonResponse
    {
        $rol->load(['usuarios', 'permisos']);
        return response()->json($rol);
    }

    // Actualizar un rol existente
    public function update(Request $request, Rol $rol): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string|max:255'
        ]);

        $rol->update($request->only(['nombre', 'descripcion']));

        return response()->json($rol);
    }

    // Eliminar un rol
    public function destroy(Rol $rol): JsonResponse
    {
        $rol->delete();
        return response()->json(['message' => 'Rol eliminado correctamente']);
    }
}
