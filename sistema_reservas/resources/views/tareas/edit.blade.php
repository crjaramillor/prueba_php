@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Tarea</h1>

        <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $tarea->descripcion) }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control">
                    <option value="Asignada" {{ old('estado', $tarea->estado) == 'Asignada' ? 'selected' : '' }}>Asignada</option>
                    <option value="En Proceso" {{ old('estado', $tarea->estado) == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="Solucionada" {{ old('estado', $tarea->estado) == 'Solucionada' ? 'selected' : '' }}>Solucionada</option>
                    <option value="No Solucionada" {{ old('estado', $tarea->estado) == 'No Solucionada' ? 'selected' : '' }}>No Solucionada</option>
                </select>
                @if(in_array(old('estado', $tarea->estado), ['Solucionada', 'No Solucionada']) && !$errors->has('comentario'))
                    <small class="text-danger">El comentario es obligatorio cuando el estado es "Solucionada" o "No Solucionada".</small>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="quien_asume_costo">Quién Asume el Costo</label>
                <select name="quien_asume_costo" class="form-control">
                    <option value="Cliente" {{ old('quien_asume_costo', $tarea->quien_asume_costo) == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="Propietario" {{ old('quien_asume_costo', $tarea->quien_asume_costo) == 'Propietario' ? 'selected' : '' }}>Propietario</option>
                    <option value="Homeselect" {{ old('quien_asume_costo', $tarea->quien_asume_costo) == 'Homeselect' ? 'selected' : '' }}>Homeselect</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="encargado">Encargado</label>
                <select name="encargado" class="form-control" required>
                    <option value="">Seleccione un encargado</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('encargado', $tarea->encargado_id) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="costo">Costo</label>
                <input type="number" name="costo" class="form-control" value="{{ old('costo', $tarea->costo) }}">
            </div>

            <div class="form-group mb-3">
                <label for="comentario">Comentario</label>
                <textarea name="comentario" class="form-control">{{ old('comentario', $tarea->comentario) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
        </form>
    </div>
@endsection
