@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Propiedad</h1>
        <form action="{{ route('propiedades.update', $propiedad->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $propiedad->name) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $propiedad->address) }}">
            </div>

            <div class="form-group mb-3">
                <label for="city">Ciudad</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $propiedad->city) }}">
            </div>

            <div class="form-group mb-3">
                <label for="state">Estado/Provincia</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $propiedad->state) }}">
            </div>

            <div class="form-group mb-3">
                <label for="price_per_night">Precio por noche</label>
                <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $propiedad->price_per_night) }}">
            </div>

            <div class="form-group mb-3">
                <label for="owner_id">Propietario (ID)</label>
                <input type="text" class="form-control" id="owner_id" name="owner_id" value="{{ old('owner_id', $propiedad->owner_id) }}" readonly>
                <small class="form-text text-muted">No se puede cambiar el propietario.</small>
            </div>

            <div class="form-group mb-3">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $propiedad->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('propiedades.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
