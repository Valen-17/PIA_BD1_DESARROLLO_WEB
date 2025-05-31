@extends('layouts.app')

@section('title', 'Crear Evaluación')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Crear Evaluación</h1>
                    <p class="text-muted">Complete el formulario de evaluación del proyecto</p>
                </div>
                <div>
                    <a href="{{ route('evaluaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluaciones.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <!-- Información del Proyecto -->
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Información del Proyecto</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="proyectoId" class="form-label">Proyecto *</label>
                                    <select name="proyectoId" id="proyectoId" class="form-select" required onchange="mostrarInfoProyecto()">
                                        <option value="">Seleccione un proyecto</option>
                                        @foreach($proyectos as $proyecto)
                                            <option value="{{ $proyecto->id }}" 
                                                    {{ (isset($proyecto) && $proyecto->id == old('proyectoId', $proyecto->id ?? '')) ? 'selected' : '' }}
                                                    data-descripcion="{{ $proyecto->descripcion }}"
                                                    data-tipo="{{ $proyecto->tipoProyecto->nombre ?? '' }}"
                                                    data-estado="{{ $proyecto->estadoFormateado() }}">
                                                {{ $proyecto->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="evaluadorId" class="form-label">Evaluador *</label>
                                    <select name="evaluadorId" id="evaluadorId" class="form-select" required>
                                        <option value="">Seleccione un evaluador</option>
                                        @foreach($evaluadores as $evaluador)
                                            <option value="{{ $evaluador->id }}" {{ old('evaluadorId') == $evaluador->id ? 'selected' : '' }}>
                                                {{ $evaluador->nombreCompleto }}
                                                @if($evaluador->especialidad)
                                                    - {{ $evaluador->especialidad }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Información adicional del proyecto seleccionado -->
                        <div id="infoProyecto" class="alert alert-info" style="display: none;">
                            <h6><strong>Información del Proyecto:</strong></h6>
                            <p><strong>Descripción:</strong> <span id="descripcionProyecto"></span></p>
                            <p><strong>Tipo:</strong> <span id="tipoProyecto"></span></p>
                            <p><strong>Estado:</strong> <span id="estadoProyecto"></span></p>
                        </div>
                    </div>
                </div>

                <!-- Criterios de Evaluación -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Criterios de Evaluación (1-10)</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $criterios = [
                                    'contenido' => 'Contenido',
                                    'problematizacion' => 'Problematización',
                                    'objetivos' => 'Objetivos',
                                    'metodologia' => 'Metodología',
                                    'resultados' => 'Resultados',
                                    'potencial' => 'Potencial',
                                    'interaccionPublico' => 'Interacción con el Público',
                                    'creatividad' => 'Creatividad',
                                    'innovacion' => 'Innovación'
                                ];
                            @endphp
                            
                            @foreach($criterios as $campo => $nombre)
                                <div class="col-md-4 mb-3">
                                    <label for="{{ $campo }}" class="form-label">{{ $nombre }}</label>
                                    <select name="{{ $campo }}" id="{{ $campo }}" class="form-select">
                                        <option value="">Sin calificar</option>
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old($campo) == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Conclusiones -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Conclusiones y Observaciones</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="concluciones" class="form-label">Conclusiones</label>
                            <textarea name="concluciones" id="concluciones" class="form-control" rows="5" 
                                      placeholder="Escriba sus conclusiones y observaciones sobre el proyecto...">{{ old('concluciones') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel de Ayuda -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Guía de Evaluación</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-primary">Escala de Calificación:</h6>
                            <ul class="list-unstyled">
                                <li><strong>9-10:</strong> Excelente</li>
                                <li><strong>7-8:</strong> Bueno</li>
                                <li><strong>5-6:</strong> Regular</li>
                                <li><strong>3-4:</strong> Deficiente</li>
                                <li><strong>1-2:</strong> Muy deficiente</li>
                            </ul>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="text-primary">Criterios:</h6>
                            <small class="text-muted">
                                <strong>Contenido:</strong> Calidad y profundidad del contenido presentado.<br><br>
                                <strong>Problematización:</strong> Claridad en la identificación del problema.<br><br>
                                <strong>Objetivos:</strong> Pertinencia y claridad de los objetivos.<br><br>
                                <strong>Metodología:</strong> Adecuación de la metodología empleada.<br><br>
                                <strong>Resultados:</strong> Coherencia y relevancia de los resultados.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                            <i class="fas fa-save me-2"></i>Guardar Evaluación
                        </button>
                        <a href="{{ route('evaluaciones.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function mostrarInfoProyecto() {
    const select = document.getElementById('proyectoId');
    const option = select.options[select.selectedIndex];
    const infoDiv = document.getElementById('infoProyecto');
    
    if (option.value) {
        document.getElementById('descripcionProyecto').textContent = option.dataset.descripcion || 'Sin descripción';
        document.getElementById('tipoProyecto').textContent = option.dataset.tipo || 'Sin tipo';
        document.getElementById('estadoProyecto').textContent = option.dataset.estado || 'Sin estado';
        infoDiv.style.display = 'block';
    } else {
        infoDiv.style.display = 'none';
    }
}

// Mostrar información si hay un proyecto preseleccionado
document.addEventListener('DOMContentLoaded', function() {
    mostrarInfoProyecto();
});
</script>
@endsection