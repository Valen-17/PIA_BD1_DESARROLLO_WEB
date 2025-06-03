<?php

namespace App\Http\Controllers;

use App\Models\Evaluador;
use Illuminate\Http\Request;


class EvaluadorController extends Controller
{
    
    public function index()
    {
        $evaluadores = Evaluador::with('evaluaciones')->get();
        return view('evaluadores.index', compact('evaluadores'));
    }

    
   public function create()
    {
        $evaluadores = Evaluador::all();
        return view('evaluadores.create', compact('evaluadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:evaluadores,identificacion',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:evaluadores,email',
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:100',
        ]);

         Evaluador::create([
            'usuario_id' => $usuario->id,
            'identificacion' => 'TEMP-' . $usuario->id, // temporal
            'nombres' => $input['username'],
            'apellidos' => '',
            'email' => $usuario->email,
        ]);

        return redirect()->route('evaluadores.index')
                         ->with('success', 'Evaluador creado correctamente');
    }

    public function show(Evaluador $evaluador)
    {
        $evaluador->load('evaluaciones.proyecto');
        return view('evaluadores.show', compact('evaluador'));
    }

        public function edit(Evaluador $evaluador)
    {
        return view('evaluadores.edit', compact('evaluador'));
    }


     public function update(Request $request, Evaluador $evaluador)
    {
        $request->validate([
            'identificacion' => 'required|string|max:20|unique:evaluadores,identificacion,' . $evaluador->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:evaluadores,email,' . $evaluador->id,
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:255'
        ]);

        $evaluador->update($request->all());

        return redirect()->route('evaluadores.index')
                         ->with('success', 'Evaluador actualizado correctamente');
    }
    

    public function destroy(Evaluador $evaluador)
    {
        $evaluador->delete();
        return redirect()->route('evaluadores.index')
                         ->with('success', 'Evaluador eliminado correctamente');
    }
}
