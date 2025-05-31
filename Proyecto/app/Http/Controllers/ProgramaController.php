<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Departamento;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programas = Programa::with('departamento.facultad.institucion')->get();
        return view('programas.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamentos = Departamento::with('facultad.institucion')->get();
        return view('programas.create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'departamentoId' => 'required|exists:departamentos,id'
        ]);

        Programa::create($request->all());

        return redirect()->route('programas.index')
                        ->with('success', 'Programa creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Programa $programa)
    {
        $programa->load([
            'departamento.facultad.institucion',
            'asignaturas',
            'docentes',
            'estudiantes'
        ]);
        return view('programas.show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programa $programa)
    {
        $departamentos = Departamento::with('facultad.institucion')->get();
        return view('programas.edit', compact('programa', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programa $programa)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'departamentoId' => 'required|exists:departamentos,id'
        ]);

        $programa->update($request->all());

        return redirect()->route('programas.index')
                        ->with('success', 'Programa actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programa $programa)
    {
        $programa->delete();

        return redirect()->route('programas.index')
                        ->with('success', 'Programa eliminado correctamente');
    }
}