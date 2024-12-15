<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Propiedades;
use App\Models\User;
use Illuminate\Http\Request;

class IncidenciasController extends Controller
{
    public function create()
    {
        $propiedades = Propiedades::all();
        $clientes = User::where('role', 'cliente')->get();
        return view('incidencias.create', compact('propiedades', 'clientes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'propiedad_id' => 'required|exists:propiedades,id',
            'user_id' => 'required|exists:users,id',
            'descripcion' => 'required|string',
        ]);

        Incidencia::create([
            'propiedad_id' => $request->propiedad_id,
            'user_id' => $request->user_id,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('incidencias.index')->with('success', 'Incidencia creada exitosamente.');
    }

    public function index()
    {
        
        $incidencias = Incidencia::with('propiedad', 'cliente', 'tareas')->get();
        
        return view('incidencias.index', compact('incidencias'));
    }

    public function edit($id)
    {
        $incidencia = Incidencia::findOrFail($id); 
        $propiedades = Propiedades::all();
        $clientes = User::where('role', 'cliente')->get(); 
        
        return view('incidencias.edit', compact('incidencia', 'propiedades', 'clientes'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'propiedad_id' => 'required|exists:propiedades,id',
            'user_id' => 'required|exists:users,id',
            'descripcion' => 'required|string',
            'estado' => 'required|in:Abierta,Pendiente,Cerrada', 
        ]);
        

        $incidencia = Incidencia::findOrFail($id);
        $incidencia->update([
            'propiedad_id' => $request->propiedad_id,
            'user_id' => $request->user_id,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada exitosamente.');
    }


}
