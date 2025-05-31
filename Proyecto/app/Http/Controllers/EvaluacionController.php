<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Proyecto;
use App\Models\Evaluador;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    // Método index modificado para mostrar proyectos disponibles para evaluar
    public function index()
    {
        // Obtener todos los proyectos con sus relaciones
        $proyectos = Proyecto::with(['tipoProyecto', 'evaluaciones.evaluador'])
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        return view('evaluaciones.index', compact('proyectos'));
    }

    // Método para mostrar el formulario de evaluación para un proyecto específico
    public function create(Request $request)
    {
        $proyectoId = $request->get('proyecto_id');
        
        if ($proyectoId) {
            $proyecto = Proyecto::with('tipoProyecto')->findOrFail($proyectoId);
        } else {
            $proyecto = null;
        }
        
        $proyectos = Proyecto::all();
        $evaluadores = Evaluador::all();
        
        return view('evaluaciones.create', compact('proyectos', 'evaluadores', 'proyecto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyectoId' => 'required|exists:proyectos,id',
            'evaluadorId' => 'required|exists:evaluadores,id',
            'contenido' => 'nullable|integer|min:1|max:10',
            'problematizacion' => 'nullable|integer|min:1|max:10',
            'objetivos' => 'nullable|integer|min:1|max:10',
            'metodologia' => 'nullable|integer|min:1|max:10',
            'resultados' => 'nullable|integer|min:1|max:10',
            'potencial' => 'nullable|integer|min:1|max:10',
            'interaccionPublico' => 'nullable|integer|min:1|max:10',
            'creatividad' => 'nullable|integer|min:1|max:10',
            'innovacion' => 'nullable|integer|min:1|max:10',
            'concluciones' => 'nullable|string'
        ]);

        Evaluacion::create($request->all());

        return redirect()->route('evaluaciones.index')
                         ->with('success', 'Evaluación creada exitosamente');
    }

    public function show(Evaluacion $evaluacion)
    {
        $evaluacion->load(['proyecto', 'evaluador']);
        return view('evaluaciones.show', compact('evaluacion'));
    }

    public function edit(Evaluacion $evaluacion)
    {
        $proyectos = Proyecto::all();
        $evaluadores = Evaluador::all();
        return view('evaluaciones.edit', compact('evaluacion', 'proyectos', 'evaluadores'));
    }

    public function update(Request $request, Evaluacion $evaluacion)
    {
        $request->validate([
            'proyectoId' => 'required|exists:proyectos,id',
            'evaluadorId' => 'required|exists:evaluadores,id',
            'contenido' => 'nullable|integer|min:1|max:10',
            'problematizacion' => 'nullable|integer|min:1|max:10',
            'objetivos' => 'nullable|integer|min:1|max:10',
            'metodologia' => 'nullable|integer|min:1|max:10',
            'resultados' => 'nullable|integer|min:1|max:10',
            'potencial' => 'nullable|integer|min:1|max:10',
            'interaccionPublico' => 'nullable|integer|min:1|max:10',
            'creatividad' => 'nullable|integer|min:1|max:10',
            'innovacion' => 'nullable|integer|min:1|max:10',
            'concluciones' => 'nullable|string'
        ]);

        $evaluacion->update($request->all());

        return redirect()->route('evaluaciones.index')
                         ->with('success', 'Evaluación actualizada exitosamente');
    }

    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return redirect()->route('evaluaciones.index')
                         ->with('success', 'Evaluación eliminada exitosamente');
    }

    // Método para listar todas las evaluaciones realizadas
    public function listarEvaluaciones()
    {
        $evaluaciones = Evaluacion::with(['proyecto', 'evaluador'])->get();
        return view('evaluaciones.lista', compact('evaluaciones'));
    }

    public function lista()
    {
        $proyectos = Proyecto::with(['tipoProyecto', 'evaluaciones.evaluador'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('evaluaciones.lista', compact('proyectos'));
    }
}