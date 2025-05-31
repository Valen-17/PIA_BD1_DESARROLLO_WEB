<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FacultadController extends Controller
{
    public function index()
    {
        $facultades = Facultad::with('institucion')->get();
        return view('facultades.index', compact('facultades'));
    }

    public function create()
    {
        $instituciones = Institucion::all();
        return view('facultades.create', compact('instituciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'institucionId' => 'required|exists:instituciones,id'
        ]);

        Facultad::create([
            'descripcion' => $request->descripcion,
            'institucionId' => $request-> institucionId,
        ]);

        return redirect()->route('facultades.index')
                        ->with('success', 'Facultad creada correctamente');
    }

    public function show(Facultad $facultad)
    {
        $facultad->load('institucion', 'departamentos');
        return view('facultades.show', compact('facultad'));
    }

    public function edit(Facultad $facultad)
    {
        $instituciones = Institucion::all();
        return view('facultades.edit', compact('facultad', 'instituciones'));
    }

    public function update(Request $request, Facultad $facultad)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'institucionId' => 'required|exists:instituciones,id'
        ]);

        $facultad->update([
            'descripcion' => $request->descripcion,
            'institucionId' => $request->institucionId,
        ]);

        return redirect()->route('facultades.index')
                        ->with('success', 'Facultad actualizada correctamente');
    }

    public function destroy(Facultad $facultad)
    {
        $facultad->delete();

        return redirect()->route('facultades.index')
                        ->with('success', 'Facultad eliminada correctamente');
    }

    public function getByInstitucion(Institucion $institucion): JsonResponse
    {
        $facultades = $institucion->facultades()->with('departamentos')->get();
        return response()->json($facultades);
    }
}