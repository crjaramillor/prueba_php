@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Reserva</h1>

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

        <!-- Formulario para crear reserva -->
        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf

            <!-- Selector de Propiedad -->
            <div class="form-group mb-3">
                <label for="propiedad_id">Propiedad</label>
                <select name="propiedad_id" id="propiedad_id" class="form-control @error('propiedad_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Selecciona una propiedad</option>
                    @foreach($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}">{{ $propiedad->name }}</option>
                    @endforeach
                </select>
                @error('propiedad_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Nombre del Cliente -->
            <div class="form-group">
                <label for="user_id">Cliente</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ isset($reserva) && $reserva->user_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->name }} - {{ $cliente->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha de Inicio -->
            <div class="form-group mb-3">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Fecha de Fin -->
            <div class="form-group mb-3">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                @error('fecha_fin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-success">Crear Reserva</button>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
