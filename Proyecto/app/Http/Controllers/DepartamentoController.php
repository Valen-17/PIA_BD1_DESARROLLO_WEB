<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Facultad;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::with('facultad.institucion', 'programas')->get();
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        $facultades = Facultad::with('institucion')->get();
        return view('departamentos.create', compact('facultades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'facultadId' => 'required|exists:facultades,id'
        ]);        

        Departamento::create([
            'descripcion' => $request->descripcion,
            'facultadId' => $request->facultadId,
        ]);

        return redirect()->route('departamentos.index')
                        ->with('success', 'Departamento creado correctamente');
    }

    public function show(Departamento $departamento)
    {
        $departamento->load('facultad.institucion', 'programas.asignaturas');
        return view('departamentos.show', compact('departamento'));
    }

    public function edit(Departamento $departamento)
    {
        $facultades = Facultad::with('institucion')->get();
        return view('departamentos.edit', compact('departamento', 'facultades'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'facultadId' => 'required|exists:facultades,id'
        ]);

        $departamento->update([
            'descripcion' => $request->descripcion,
            'facultadId' => $request->facultadId,
        ]);

        return redirect()->route('departamentos.index')
                        ->with('success', 'Departamento actualizado correctamente');
    }

    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return redirect()->route('departamentos.index')
                        ->with('success', 'Departamento eliminado correctamente');
    }
}