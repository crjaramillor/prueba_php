@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tareas de la Incidencia</h1>
    <p><strong>Descripción de la Incidencia:</strong> {{ $incidencia->descripcion }}</p>

    <!-- Botón para crear nueva tarea -->
    <a href="{{ route('tareas.create', $incidencia->id) }}" class="btn btn-primary mb-3">Crear Nueva Tarea</a>

    @if($incidencia->tareas->isEmpty())
        <p>No hay tareas asociadas a esta incidencia.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Quién Asume el Costo</th>
                    <th>Encargado</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidencia->tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ $tarea->quien_asume_costo ?? 'N/A' }}</td>
                    
                    <td>{{ $tarea->encargado_name }}</td>
                    <td>{{ $tarea->costo ? '$' . number_format($tarea->costo, 2) : 'N/A' }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Botón para volver a la lista de incidencias -->
    <a href="{{ route('incidencias.index') }}" class="btn btn-secondary mt-3">Volver a Incidencias</a>
</div>
@endsection
