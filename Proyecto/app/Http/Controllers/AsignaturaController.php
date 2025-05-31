<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Programa;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignatura::with('programa.departamento.facultad.institucion')->get();
        return view('asignaturas.index', compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = Programa::with('departamento.facultad.institucion')->get();
        return view('asignaturas.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'creditos' => 'nullable|integer|min:1',
            'programaId' => 'required|exists:programas,id'
        ]);

        Asignatura::create($request->all());

        return redirect()->route('asignaturas.index')
                        ->with('success', 'Asignatura creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura)
    {
        $asignatura->load([
            'programa.departamento.facultad.institucion',
            'docentes' => function($query) {
                $query->withPivot('fechaAsignacion', 'activo');
            },
            'estudiantes' => function($query) {
                $query->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'estado', 'fechaMatricula');
            },
            'proyectos' => function($query) {
                $query->withPivot('docenteId', 'grupo', 'semestre', 'año');
            }
        ]);
        return view('asignaturas.show', compact('asignatura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura)
    {
        $programas = Programa::with('departamento.facultad.institucion')->get();
        return view('asignaturas.edit', compact('asignatura', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'creditos' => 'nullable|integer|min:1',
            'programaId' => 'required|exists:programas,id'
        ]);

        $asignatura->update($request->all());

        return redirect()->route('asignaturas.index')
                        ->with('success', 'Asignatura actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();

        return redirect()->route('asignaturas.index')
                        ->with('success', 'Asignatura eliminada correctamente');
    }
}