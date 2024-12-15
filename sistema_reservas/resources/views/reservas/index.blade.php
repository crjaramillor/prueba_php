@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Reservas</h1>
        <a href="{{ route('reservas.create') }}" class="btn btn-primary">Crear Nueva Reserva</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Propiedad</th>
                    <th>Cliente</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->propiedad ? $reserva->propiedad->name : 'No disponible' }}</td>
                        <td>{{ $reserva->user ? $reserva->user->name : 'No disponible' }}</td> 
                        <td>{{ $reserva->fecha_inicio }}</td>
                        <td>{{ $reserva->fecha_fin }}</td>
                        <td>
                            <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
