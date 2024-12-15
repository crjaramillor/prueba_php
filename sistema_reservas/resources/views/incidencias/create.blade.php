@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Incidencia</h1>
        <form action="{{ route('incidencias.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="propiedad_id">Propiedad</label>
                <select name="propiedad_id" id="propiedad_id" class="form-control" required>
                    <option value="" disabled selected>Selecciona una propiedad</option>
                    @foreach($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}">{{ $propiedad->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">Cliente</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Crear Incidencia</button>
            <a href="{{ route('incidencias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
