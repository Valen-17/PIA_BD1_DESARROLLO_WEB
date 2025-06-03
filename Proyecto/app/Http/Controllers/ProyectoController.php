<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ProyectoAsignatura;
use App\Models\Asignatura;
use App\Models\Docente;
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
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();

        return view('proyectos.create', compact('tiposProyecto', 'asignaturas', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fechaInicio' => 'nullable|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'tipoProyectoId' => 'required|exists:tiposProyecto,id',
            'asignaturas' => 'required|array',
            'asignaturas.*' => 'exists:asignaturas,id',
            'docentes' => 'required|array',
            'docentes.*' => 'exists:docentes,id',
        ]);

        // Creamos el proyecto
        $proyecto = Proyecto::create($request->only([
            'titulo',
            'descripcion',
            'fechaInicio',
            'fechaFin',
            'tipoProyectoId'
        ]));

        // Guardamos relaciones con asignaturas y docentes
        $asignaturas = $request->input('asignaturas', []);
        $docentes = $request->input('docentes', []);

        foreach ($asignaturas as $index => $asignaturaId) {
            ProyectoAsignatura::create([
                'proyectoId' => $proyecto->id,
                'asignaturaId' => $asignaturaId,
                'docenteId' => $docentes[$index] ?? null,
                'grupo' => null, // O puedes capturarlo también desde el formulario si lo agregas
                'semestre' => now()->month <= 6 ? 1 : 2,
                'año' => now()->year
            ]);
        }

        return redirect()->route('proyectos.index')
                        ->with('success', 'Proyecto creado correctamente con asignaturas y docentes.');
    }


    public function edit(Proyecto $proyecto)
    {
        $tiposProyecto = TipoProyecto::all();
        $asignaturas = \App\Models\Asignatura::all();
        $docentes = \App\Models\Docente::all();

        $proyecto->load('proyectoAsignaturas');

        return view('proyectos.edit', compact('proyecto', 'tiposProyecto', 'asignaturas', 'docentes'));
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
