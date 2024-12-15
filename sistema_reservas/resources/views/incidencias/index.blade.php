@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Incidencias</h1>

        <!-- Botón para crear una nueva incidencia -->
        <a href="{{ route('incidencias.create') }}" class="btn btn-primary mb-3">Crear Nueva Incidencia</a>

        <!-- Mostrar Incidencias -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Propiedad</th>
                    <th>Cliente</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidencias as $incidencia)
                    <tr>
                        <td>{{ $incidencia->propiedad->name }}</td>
                        <td>{{ $incidencia->cliente->name }}</td>
                        <td>{{ $incidencia->descripcion }}</td>
                        <td>{{ $incidencia->estado }}</td>
                        <td>
                            <!-- Botón para crear tarea relacionada con esta incidencia -->
                            <a href="{{ route('tareas.create', $incidencia->id) }}" class="btn btn-success">Crear Tarea</a>
                            
                            <!-- Botón para ver tareas -->
                            <a href="{{ route('tareas.index', ['incidencia_id' => $incidencia->id]) }}" class="btn btn-info">
                                Ver Tareas 
                            </a>
                            

                            <!-- Botón para editar la incidencia -->
                            <a href="{{ route('incidencias.edit', $incidencia->id) }}" class="btn btn-warning">Cambiar Estado</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
