<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource (for web).
     */
    public function index()
    {
        $instituciones = Institucion::with('facultades')->get();
        return view('instituciones.index', compact('instituciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instituciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20'
        ]);

        Institucion::create($request->all());

        return redirect()->route('instituciones.index')
                        ->with('success', 'Institución creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Institucion $institucion)
    {
        $institucion->load('facultades');
        return view('instituciones.show', compact('institucion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institucion $institucion)
    {
        return view('instituciones.edit', compact('institucion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institucion $institucion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20'
        ]);

        $institucion->update($request->all());

        return redirect()->route('instituciones.index')
                        ->with('success', 'Institución actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institucion $institucion)
    {
        $institucion->delete();

        return redirect()->route('instituciones.index')
                        ->with('success', 'Institución eliminada correctamente');
    }
}