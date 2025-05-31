<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Programa;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('programa')->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $programas = Programa::all();
        return view('docentes.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:docentes',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:docentes',
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id',
        ]);

        Docente::create($request->all());
        return redirect()->route('docentes.index')->with('success', 'Docente creado correctamente');
    }

    public function show(Docente $docente)
    {
        $docente->load('programa', 'asignaturas');
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        $programas = Programa::all();
        return view('docentes.edit', compact('docente', 'programas'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:docentes,identificacion,' . $docente->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:docentes,email,' . $docente->id,
            'telefono' => 'nullable|string|max:20',
            'programaId' => 'required|exists:programas,id',
        ]);

        $docente->update($request->all());
        return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente');
    }
}
