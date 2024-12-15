@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Reserva</h1>

        <!-- Muestra de mensajes de error generales -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="propiedad_id">Propiedad</label>
                <input type="text" class="form-control" value="{{ $reserva->propiedad->name }}" disabled>
                <input type="hidden" name="propiedad_id" value="{{ $reserva->propiedad_id }}">
            </div>

            <div class="form-group mb-3">
                <label for="user_id">Cliente</label>
                <input type="text" class="form-control" value="{{ $reserva->user->name }} - {{ $reserva->user->email }}" disabled>
                <input type="hidden" name="user_id" value="{{ $reserva->user_id }}">
            </div>

            <div class="form-group mb-3">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $reserva->fecha_inicio) }}" required>
                @error('fecha_inicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $reserva->fecha_fin) }}" required>
                @error('fecha_fin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Actualizar Reserva</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
