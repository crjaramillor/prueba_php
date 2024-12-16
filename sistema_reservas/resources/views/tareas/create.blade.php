@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Tarea</h1>

        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf
            <!-- Incidencia ID oculto -->
            <input type="hidden" name="incidencia_id" value="{{ $incidencia->id }}">

            <!-- Descripción -->
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
            </div>

            <!-- Estado -->
            <div class="form-group mb-3">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="Asignada" {{ old('estado') == 'Asignada' ? 'selected' : '' }}>Asignada</option>
                    <option value="En Proceso" {{ old('estado') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="Solucionada" {{ old('estado') == 'Solucionada' ? 'selected' : '' }}>Solucionada</option>
                    <option value="No Solucionada" {{ old('estado') == 'No Solucionada' ? 'selected' : '' }}>No Solucionada</option>
                </select>
                @if ($errors->has('estado'))
                    <div class="text-danger">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
            </div>

            <!-- Quién Asume el Costo -->
            <div class="form-group mb-3">
                <label for="quien_asume_costo">Quién asume el costo</label>
                <select name="quien_asume_costo" id="quien_asume_costo" class="form-control">
                    <option value="Cliente" {{ old('quien_asume_costo') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="Propietario" {{ old('quien_asume_costo') == 'Propietario' ? 'selected' : '' }}>Propietario</option>
                    <option value="Homeselect" {{ old('quien_asume_costo') == 'Homeselect' ? 'selected' : '' }}>Homeselect</option>
                </select>
            </div>

            <!-- Encargado -->
            <div class="form-group mb-3">
                <label for="encargado">Encargado</label>
                <select name="encargado" id="encargado" class="form-control" required>
                    <option value="">Seleccione un encargado</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('encargado') == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Costo -->
            <div class="form-group mb-3">
                <label for="costo">Costo</label>
                <input type="number" name="costo" id="costo" class="form-control" value="{{ old('costo') }}">
            </div>

            <!-- Comentario -->
            <div class="form-group mb-3">
                <label for="comentario">Comentario</label>
                <textarea name="comentario" id="comentario" class="form-control" rows="4">{{ old('comentario') }}</textarea>
                @if ($errors->has('comentario'))
                    <div class="text-danger">
                        {{ $errors->first('comentario') }}
                    </div>
                @endif
            </div>

            <!-- Botones -->
            <button type="submit" class="btn btn-success">Crear Tarea</button>
            <a href="{{ route('incidencias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
