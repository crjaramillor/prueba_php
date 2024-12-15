<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;
use App\Models\User;
use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    // Mostrar todas las propiedades
    public function index()
    {
        $propiedades = Propiedades::all();
        return view('propiedades.index', compact('propiedades'));
    }

    // Mostrar formulario para crear una propiedad
    public function create()
    {
        $owners = User::where('role', 'propietario')->get();
        return view('propiedades.create', compact('owners'));
    }

    // Almacenar la nueva propiedad
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'price_per_night' => 'nullable|numeric',
            'owner_id' => 'required|exists:users,id',
            'description' => 'nullable|string|max:1000',
        ]);

        Propiedades::create($request->all());

        return redirect()->route('propiedades.index')->with('success', 'Propiedad creada con éxito.');
    }

    // Mostrar formulario para editar una propiedad
    public function edit($id)
    {
        $propiedad = Propiedades::findOrFail($id);
        $owners = User::where('role', 'propietario')->get();
        return view('propiedades.edit', compact('propiedad', 'owners'));
    }

    // Actualizar una propiedad existente
    public function update(Request $request, $id)
    {
        $propiedad = Propiedades::findOrFail($id);

        $propiedad->update($request->all());

        return redirect()->route('propiedades.index')->with('success', 'Propiedad actualizada con éxito.');
    }

    // Eliminar una propiedad
    public function destroy($id)
    {
        $propiedad = Propiedades::findOrFail($id);

        // Verificar si la propiedad existe antes de eliminarla
        if (!$propiedad) {
            return redirect()->route('propiedades.index')->with('error', 'Propiedad no encontrada.');
        }

        // Intentar eliminar la propiedad
        try {
            $propiedad->delete();
            return redirect()->route('propiedades.index')->with('success', 'Propiedad eliminada con éxito.');
        } catch (\Exception $e) {
            
            return redirect()->route('propiedades.index')->with('error', 'No se pudo eliminar la propiedad. ' . $e->getMessage());
        }
    }
}

