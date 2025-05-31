<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Programa;
use App\Models\Proyecto;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::with('programa.departamento.facultad')->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = Programa::with('departamento.facultad')->get();
        return view('estudiantes.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:estudiantes',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:estudiantes',
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id'
        ]);

        Estudiante::create($request->all());

        return redirect()->route('estudiantes.index')
                        ->with('success', 'Estudiante creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        $estudiante->load([
            'programa.departamento.facultad',
            'proyectos' => function($query) {
                $query->withPivot('rol', 'fecha_asignacion')
                      ->orderBy('created_at', 'desc');
            },
            'asignaturas' => function($query) {
                $query->withPivot('semestre', 'año', 'grupo', 'estado', 'notaFinal', 'fechaMatricula')
                      ->orderBy('año', 'desc')
                      ->orderBy('semestre', 'desc');
            }
        ]);
        
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        $programas = Programa::with('departamento.facultad')->get();
        return view('estudiantes.edit', compact('estudiante', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:estudiantes,identificacion,' . $estudiante->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:estudiantes,email,' . $estudiante->id,
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id'
        ]);

        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')
                        ->with('success', 'Estudiante actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();

        return redirect()->route('estudiantes.index')
                        ->with('success', 'Estudiante eliminado correctamente');
    }

    /**
     * Asignar estudiante a un proyecto
     */
    public function asignarProyecto(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'rol' => 'nullable|string|max:50'
        ]);

        // Verificar si ya está asignado al proyecto
        if ($estudiante->estaEnProyecto($request->proyecto_id)) {
            return back()->with('error', 'El estudiante ya está asignado a este proyecto');
        }

        $estudiante->proyectos()->attach($request->proyecto_id, [
            'rol' => $request->rol ?? 'participante',
            'fecha_asignacion' => now()
        ]);

        return back()->with('success', 'Estudiante asignado al proyecto correctamente');
    }

    /**
     * Matricular estudiante en una asignatura
     */
    public function matricularAsignatura(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'asignatura_codigo' => 'required|exists:asignaturas,codigo',
            'semestre' => 'required|string|max:10',
            'año' => 'required|integer',
            'grupo' => 'nullable|string|max:10'
        ]);

        // Verificar si ya está matriculado en esta asignatura para el mismo período
        $yaMatriculado = $estudiante->asignaturas()
            ->where('asignatura_codigo', $request->asignatura_codigo)
            ->wherePivot('semestre', $request->semestre)
            ->wherePivot('año', $request->año)
            ->exists();

        if ($yaMatriculado) {
            return back()->with('error', 'El estudiante ya está matriculado en esta asignatura para este período');
        }

        $estudiante->asignaturas()->attach($request->asignatura_codigo, [
            'semestre' => $request->semestre,
            'año' => $request->año,
            'grupo' => $request->grupo ?? 'A',
            'estado' => 'matriculado',
            'fecha_matricula' => now()
        ]);

        return back()->with('success', 'Estudiante matriculado correctamente');
    }

    /**
     * Ver proyectos del estudiante
     */
    public function proyectos(Estudiante $estudiante)
    {
        $proyectosActivos = $estudiante->proyectosActivos()->with(['tipoProyecto', 'evaluaciones'])->get();
        $proyectosTerminados = $estudiante->proyectosTerminados()->with(['tipoProyecto', 'evaluaciones'])->get();

        return view('estudiantes.proyectos', compact('estudiante', 'proyectosActivos', 'proyectosTerminados'));
    }

    /**
     * Ver historial académico del estudiante
     */
    public function historialAcademico(Estudiante $estudiante)
    {
        $historial = $estudiante->asignaturas()
            ->withPivot('semestre', 'año', 'grupo', 'estado', 'nota_final', 'fecha_matricula')
            ->orderBy('año', 'desc')
            ->orderBy('semestre', 'desc')
            ->get();

        return view('estudiantes.historial', compact('estudiante', 'historial'));
    }
}