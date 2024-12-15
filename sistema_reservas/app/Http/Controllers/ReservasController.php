<?php

    namespace App\Http\Controllers;

    use App\Models\reserva;
    use Illuminate\Http\Request;
    use Carbon\Carbon;
    use App\Models\propiedades;
    use App\Models\User; 

    class ReservasController extends Controller
    {
        // Mostrar todas las reservas
        public function index()
        {
            $reservas = reserva::with(['propiedad', 'user'])->get();
            return view('reservas.index', compact('reservas'));
        }

        // Mostrar el formulario de creación de reserva
        public function create()
        {
            $propiedades = propiedades::all(); // Obtener todas las propiedades
            $clientes = User::where('role', 'cliente')->get();
        
            return view('reservas.create', compact('propiedades', 'clientes'));
        }

        // Validación de disponibilidad y creación de reserva
        public function store(Request $request)
        {   
            // Validar los datos de entrada
            $request->validate([
                'propiedad_id' => 'required|exists:propiedades,id',
                'user_id' => 'required|exists:users,id', 
                'fecha_inicio' => 'required|date|after_or_equal:today',
                'fecha_fin' => 'required|date|after:fecha_inicio',
            ]);

            // Validar si la propiedad ya está reservada en las fechas proporcionadas
            $reservasExistentes = reserva::where('propiedad_id', $request->propiedad_id)
                ->where(function($query) use ($request) {
                    $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
                        ->orWhereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin]);
                })
                ->exists();

            if ($reservasExistentes) {
                return redirect()->back()->with('error', 'La propiedad ya está reservada en esas fechas.');
            }

            // Crear la reserva con los datos correctos
            reserva::create([
                'propiedad_id' => $request->input('propiedad_id'),
                'user_id' => $request->input('user_id'), 
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
            ]);

            return redirect()->route('reservas.index')->with('success', 'Reserva realizada exitosamente.');
        }

        // Mostrar el formulario de edición de reserva
        public function edit($id)
        {
            // Buscar la reserva y cargar las relaciones 'propiedad' y 'user'
            $reserva = Reserva::with(['propiedad', 'user'])->findOrFail($id);
        
            // Obtener todas las propiedades disponibles
            $propiedades = Propiedades::all();
        
            // Obtener todos los clientes (usuarios con rol 'cliente')
            $users = User::where('role', 'cliente')->get();
        
            // Pasar las variables a la vista
            return view('reservas.edit', compact('reserva', 'propiedades', 'users'));
        }
        
        // Actualizar una reserva
        public function update(Request $request, $id)
        {
            // Validación de los datos recibidos
            $request->validate([
                'propiedad_id' => 'required|exists:propiedades,id', 
                'user_id' => 'required|exists:users,id', 
                'fecha_inicio' => 'required|date|after_or_equal:today', 
                'fecha_fin' => 'required|date|after:fecha_inicio', 
            ]);
        
            // Buscamos la reserva a actualizar
            $reserva = Reserva::findOrFail($id);
        
            
            $reservasExistentes = Reserva::where('propiedad_id', $request->propiedad_id)
                ->where(function ($query) use ($request, $reserva) {
                    // Verificamos si alguna reserva se solapa con las fechas de la reserva actual
                    $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
                        ->orWhereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin]);
                })
                ->where('id', '!=', $reserva->id) 
                ->exists();
        
            if ($reservasExistentes) {
                // Si ya hay una reserva en esas fechas, retorna un mensaje de error
                return redirect()->back()->with('error', 'La propiedad ya está reservada en esas fechas.');
            }
        
            // reserva con los nuevos datos
            $reserva->update([
                'propiedad_id' => $request->input('propiedad_id'),
                'user_id' => $request->input('user_id'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
            ]);
        
            return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
        }
        
        // Eliminar una reserva
        public function destroy($id)
        {
            $reserva = reserva::findOrFail($id);
            $reserva->delete();

            return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
        }
    }
