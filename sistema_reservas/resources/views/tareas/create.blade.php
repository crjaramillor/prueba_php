@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Tarea</h1>
        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf
            <input type="hidden" name="incidencia_id" value="{{ $incidencia->id }}">

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="Asignada">Asignada</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Solucionada">Solucionada</option>
                    <option value="No Solucionada">No Solucionada</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quien_asume_costo">Quién asume el costo</label>
                <select name="quien_asume_costo" id="quien_asume_costo" class="form-control">
                    <option value="Cliente">Cliente</option>
                    <option value="Propietario">Propietario</option>
                    <option value="Homeselect">Homeselect</option>
                </select>
            </div>

            <div class="form-group">
                <label for="encargado">Encargado</label>
                <select name="encargado" id="encargado" class="form-control" required>
                    <option value="">Seleccione un encargado</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="costo">Costo</label>
                <input type="number" name="costo" id="costo" class="form-control">
            </div>

            <div class="form-group">
                <label for="comentario">Comentario</label>
                <textarea name="comentario" id="comentario" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Crear Tarea</button>
            <a href="{{ route('incidencias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
