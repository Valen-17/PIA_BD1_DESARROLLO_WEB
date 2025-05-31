<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        $usuarios = Usuario::with('roles.permisos')->get();
        return response()->json($usuarios);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:8',
            'activo' => 'boolean'
        ]);

        $usuario = Usuario::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activo' => $request->activo ?? true
        ]);

        return response()->json($usuario, 201);
    }

    public function show(Usuario $usuario): JsonResponse
    {
        $usuario->load('roles.permisos');
        return response()->json($usuario);
    }

    public function update(Request $request, Usuario $usuario): JsonResponse
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:usuarios,username,' . $usuario->id,
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'sometimes|string|min:8',
            'activo' => 'boolean'
        ]);

        $data = $request->only(['username', 'email', 'activo']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);
        return response()->json($usuario);
    }

    public function destroy(Usuario $usuario): JsonResponse
    {
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    public function asignarRol(Request $request, Usuario $usuario): JsonResponse
    {
        $request->validate([
            'rolId' => 'required|exists:roles,id'
        ]);

        $usuario->roles()->attach($request->rolId, [
            'fechaAsignacion' => now()
        ]);

        return response()->json(['message' => 'Rol asignado correctamente']);
    }

    public function revocarRol(Usuario $usuario, $rolId): JsonResponse
    {
        $usuario->roles()->detach($rolId);
        return response()->json(['message' => 'Rol revocado correctamente']);
    }

    public function getPermisos(Usuario $usuario): JsonResponse
    {
        $permisos = $usuario->roles()->with('permisos')->get()
            ->pluck('permisos')->flatten()->unique('id');
        
        return response()->json($permisos);
    }
}