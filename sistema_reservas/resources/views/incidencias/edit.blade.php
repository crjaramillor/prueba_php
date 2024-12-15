@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Incidencia</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('incidencias.update', $incidencia->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="propiedad_id">Propiedad</label>
                <select name="propiedad_id" id="propiedad_id" class="form-control">
                    @foreach ($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}" {{ $incidencia->propiedad_id == $propiedad->id ? 'selected' : '' }}>
                            {{ $propiedad->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">Cliente</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $incidencia->user_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ $incidencia->descripcion }}</textarea>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" required class="form-control">
                    <option value="Abierta">Abierta</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Cerrada">Cerrada</option>
                </select>
                
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('incidencias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
