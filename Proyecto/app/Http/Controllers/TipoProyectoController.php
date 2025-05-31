<?php

namespace App\Http\Controllers;

use App\Models\TipoProyecto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TipoProyectoController extends Controller
{
    // Listar todos los tipos de proyecto
    public function index()
    {
        $tipos = TipoProyecto::with('proyectos')->get();
        return view('tipo-proyectos.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo-proyectos.create');
    }

    // Crear un nuevo tipo de proyecto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:tiposProyecto,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        TipoProyecto::create($request->only(['nombre', 'descripcion']));

         return redirect()->route('tipo-proyectos.index')
                         ->with('success', 'Tipo de proyecto creado correctamente');
    }

    // Mostrar un tipo de proyecto específico (Vista Web)
    public function show(TipoProyecto $tipoProyecto)
    {
        return view('tipo-proyectos.show', compact('tipoProyecto'));
    }

    // Mostrar formulario de edición
    public function edit(TipoProyecto $tipoProyecto)
    {
        return view('tipo-proyectos.edit', compact('tipoProyecto'));
    }

    // Actualizar un tipo de proyecto
    public function update(Request $request, TipoProyecto $tipoProyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:tiposProyecto,nombre,' . $tipoProyecto->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        $tipoProyecto->update($request->only(['nombre', 'descripcion']));

         return redirect()->route('tipo-proyectos.index')
                         ->with('success', 'Tipo de proyecto actualizado correctamente');
    }

    // Eliminar un tipo de proyecto
    public function destroy(TipoProyecto $tipoProyecto)
    {
        $tipoProyecto->delete();
         return redirect()->route('tipo-proyectos.index')
                         ->with('success', 'Tipo de proyecto eliminado correctamente');
    }
}
