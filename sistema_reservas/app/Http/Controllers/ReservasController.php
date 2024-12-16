<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Propiedades;
use App\Models\User;

class ReservasController extends Controller
{
    // Mostrar todas las reservas
    public function index()
    {
        $reservas = Reserva::with(['propiedad', 'user'])->get();
        return view('reservas.index', compact('reservas'));
    }

    // Mostrar el formulario de creación de reserva
    public function create()
    {
        $propiedades = Propiedades::all(); // Obtener todas las propiedades
        $clientes = User::where('role', 'cliente')->get();
        return view('reservas.create', compact('propiedades', 'clientes'));
    }

    // Validación de disponibilidad y creación de reserva
    public function store(Request $request)
    {
        $request->validate([
            'propiedad_id' => 'required|exists:propiedades,id',
            'user_id' => 'required|exists:users,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        // Validar que no haya reservas en conflicto
        $reservasExistentes = Reserva::where('propiedad_id', $request->propiedad_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('fecha_inicio', [$request->fecha_inicio, Carbon::parse($request->fecha_fin)->subDay()])
                    ->orWhereBetween('fecha_fin', [Carbon::parse($request->fecha_inicio)->addDay(), $request->fecha_fin])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('fecha_inicio', '<=', $request->fecha_inicio)
                            ->where('fecha_fin', '>=', Carbon::parse($request->fecha_fin)->subDay());
                    });
            })
            ->exists();

        if ($reservasExistentes) {
            return redirect()->back()->with('error', 'La propiedad ya está reservada en esas fechas.');
        }

        Reserva::create($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva realizada exitosamente.');
    }

    // Mostrar el formulario de edición de reserva
    public function edit($id)
    {
        $reserva = Reserva::with(['propiedad', 'user'])->findOrFail($id);
        $propiedades = Propiedades::all();
        $users = User::where('role', 'cliente')->get();
        return view('reservas.edit', compact('reserva', 'propiedades', 'users'));
    }

    // Actualizar una reserva
    public function update(Request $request, $id)
    {
        $request->validate([
            'propiedad_id' => 'required|exists:propiedades,id',
            'user_id' => 'required|exists:users,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $reserva = Reserva::findOrFail($id);

        // Validar que no haya conflictos con otras reservas
        $reservasExistentes = Reserva::where('propiedad_id', $request->propiedad_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('fecha_inicio', [$request->fecha_inicio, Carbon::parse($request->fecha_fin)->subDay()])
                    ->orWhereBetween('fecha_fin', [Carbon::parse($request->fecha_inicio)->addDay(), $request->fecha_fin])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('fecha_inicio', '<=', $request->fecha_inicio)
                            ->where('fecha_fin', '>=', Carbon::parse($request->fecha_fin)->subDay());
                    });
            })
            ->where('id', '!=', $reserva->id) // Excluir la reserva actual
            ->exists();

        if ($reservasExistentes) {
            return redirect()->back()->with('error', 'La propiedad ya está reservada en esas fechas.');
        }

        $reserva->update($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }
    public function showReservas($id)
    {
        // Obtener la propiedad por ID
        $propiedad = Propiedades::findOrFail($id);
    
        // Obtener las reservas que tienen el mismo propiedad_id
        $reservas = Reserva::where('propiedad_id', $propiedad->id)->get();
    
        // Retornar la vista con la propiedad y las reservas
        return view('reservas.show', compact('propiedad', 'reservas'));
    }

    // Eliminar una reserva
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
