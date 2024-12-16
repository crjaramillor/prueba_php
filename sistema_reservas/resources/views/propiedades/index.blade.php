@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Propiedades</h1>
        <a href="{{ route('propiedades.create') }}" class="btn btn-primary mb-3">Crear Propiedad</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Precio por noche</th>
                    <th>Propietario</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($propiedades as $propiedad)
                    <tr>
                        <td>{{ $propiedad->id }}</td>
                        <td>{{ $propiedad->name }}</td>
                        <td>{{ $propiedad->address }}</td>
                        <td>{{ $propiedad->city }}</td>
                        <td>{{ $propiedad->state }}</td>
                        <td>{{ $propiedad->price_per_night }}</td>
                        <td>{{ $propiedad->owner_id }}</td>
                        <td>{{ $propiedad->description }}</td>
                        <td>
                            <a href="{{ route('propiedades.edit', $propiedad->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('propiedades.destroy', $propiedad->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <a href="{{ route('reservas.showPropiedad', $propiedad->id) }}" class="btn btn-info">
                                Ver Reservas Asociadas
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
