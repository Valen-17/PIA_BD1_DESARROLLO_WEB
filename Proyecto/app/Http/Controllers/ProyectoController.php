<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\TipoProyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with('tipoProyecto', 'asignaturas', 'evaluaciones')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $tiposProyecto = TipoProyecto::all();
        return view('proyectos.create', compact('tiposProyecto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fechaInicio' => 'nullable|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoProyectoId' => 'required|exists:tiposProyecto,id',
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')
                         ->with('success', 'Proyecto creado correctamente');
    }

    public function show(Proyecto $proyecto)
    {
        $proyecto->load([
            'tipoProyecto',
            'asignaturas.programa',
            'evaluaciones.evaluador',
        ]);

        return view('proyectos.show', compact('proyecto'));
    }

    public function edit(Proyecto $proyecto)
    {
        $tiposProyecto = TipoProyecto::all();
        return view('proyectos.edit', compact('proyecto', 'tiposProyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fechaInicio' => 'nullable|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoProyectoId' => 'required|exists:tiposProyecto,id',
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
                         ->with('success', 'Proyecto actualizado correctamente');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index')
                         ->with('success', 'Proyecto eliminado correctamente');
    }
}
