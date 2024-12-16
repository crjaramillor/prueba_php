<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use App\Models\User; 

class TareasController extends Controller
{

    public function index($incidencia_id)
    {
        // Verifica que la incidencia exista y carga sus tareas
        $incidencia = Incidencia::with('tareas')->findOrFail($incidencia_id);
        
        foreach ($incidencia->tareas as $tarea) {
            $tarea->encargado_name = User::find($tarea->encargado_id)->name ?? 'N/A';
        }

        return view('tareas.index', compact('incidencia'));
    }


    public function create($incidenciaId)
    {
        $incidencia = Incidencia::findOrFail($incidenciaId);
        $usuarios = User::where('role', 'encargado')->get(); 
    
        return view('tareas.create', compact('incidencia', 'usuarios'));
    }
    


    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|in:Asignada,En Proceso,Solucionada,No Solucionada',
            'quien_asume_costo' => 'nullable|in:Cliente,Propietario,Homeselect',
            'encargado' => 'required|exists:users,id', 
            'costo' => 'nullable|numeric|min:0',
            'comentario' => [
                // Validación condicional para el campo comentario
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->estado, ['Solucionada', 'No Solucionada']) && empty($value)) {
                        $fail('El comentario es obligatorio cuando el estado es "Solucionada" o "No Solucionada".');
                    }
                },
            ],
        ]);

        // Crear la tarea
        $tarea = new Tarea();
        $tarea->incidencia_id = $request->incidencia_id;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado = $request->estado;
        $tarea->quien_asume_costo = $request->quien_asume_costo;
        $tarea->encargado_id = $request->encargado; 
        $tarea->costo = $request->costo;
        $tarea->comentario = $request->comentario;
        $tarea->save();

        return redirect()->route('tareas.index', $request->incidencia_id)->with('success', 'Tarea creada exitosamente');
    }
    public function edit($tarea_id)
    {
        $tarea = Tarea::with('encargado')->findOrFail($tarea_id);


        $usuarios = User::where('role', 'encargado')->get();

        return view('tareas.edit', compact('tarea', 'usuarios'));
    }
    public function update(Request $request, $tarea_id)
    {
        // Validación
        $request->validate([
            'estado' => 'required|in:Asignada,En Proceso,Solucionada,No Solucionada',
            'quien_asume_costo' => 'nullable|in:Cliente,Propietario,Homeselect',
            'encargado' => 'required|exists:users,id',
            'costo' => 'nullable|numeric|min:0',
            'comentario' => [
                // Validación condicional para el campo comentario
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->estado, ['Solucionada', 'No Solucionada']) && empty($value)) {
                        $fail('El comentario es obligatorio cuando el estado es "Solucionada" o "No Solucionada".');
                    }
                },
            ],
        ]);
    
        // Actualizar la tarea
        $tarea = Tarea::findOrFail($tarea_id);
        $tarea->update([
            'estado' => $request->estado,
            'quien_asume_costo' => $request->quien_asume_costo,
            'encargado_id' => $request->encargado,
            'costo' => $request->costo,
            'comentario' => $request->comentario,
        ]);
    
        return redirect()->route('tareas.index', $tarea->incidencia_id)
            ->with('success', 'Tarea actualizada exitosamente.');
    }
    


    public function destroy($tarea_id)
    {
        $tarea = Tarea::findOrFail($tarea_id);

        // Eliminar la tarea
        $tarea->delete();

        // Redirigir de vuelta a la lista de tareas de la incidencia
        return redirect()->route('tareas.index', $tarea->incidencia_id)->with('success', 'Tarea eliminada exitosamente.');
    }
}
