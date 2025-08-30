<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredientes; // Asegúrate de importar el modelo Ingredientes
use App\Models\UnidadMedida; // Importa el modelo de UnidadMedida

class IngredientesController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los ingredientes
        // Por ejemplo, podrías usar un modelo para obtener los datos de la base de datos
        // return Ingredientes::all();
       // $ingredientes = Ingredientes::all();
        $ingredientes = Ingredientes::with('unidadMedida')->get();

        // Obtiene todas las unidades de medida para el menú desplegable.
        $unidadesMedida = UnidadMedida::all();

        return view('pages.ingredientes', compact('ingredientes', 'unidadesMedida'));

        // Si necesitas retornar una respuesta JSON, puedes hacer lo siguiente:
        // return response()->json($Ingredientes);

        // Carga la relación 'unidadMedida' para mostrar el nombre en la vista    

    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida_id' => 'required|exists:unidades_medida,id', // Valida que el ID exista        
            'costo_unitario' => 'required|numeric|min:0',
            'densidad' => 'nullable|numeric|min:0' // La densidad puede ser opcional
        ]);

        Ingredientes::create([
            'nombre' => $request->nombre,
            'unidad_medida_id' => $request->unidad_medida_id,
            'costo_unitario' => $request->costo_unitario,
            'densidad' => $request->densidad,
            'fecha_actualizacion' => now() // También podrías actualizar la fecha aquí
        ]);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente agregado correctamente.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida_id' => 'required|exists:unidades_medida,id',
            'costo_unitario' => 'required|numeric|min:0',
            'densidad' => 'nullable|numeric|min:0'
        ]);

        $ingrediente = Ingredientes::findOrFail($id);
        $ingrediente->update([
            'nombre' => $request->nombre,'unidad_medida_id' => $request->unidad_medida_id,
            'costo_unitario' => $request->costo_unitario,
            'densidad' => $request->densidad,
            'fecha_actualizacion' => now()
        ]);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente actualizado correctamente.');
    }
    public function destroy($id)
    {
        $ingrediente = Ingredientes::findOrFail($id);
        $ingrediente->delete();

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente eliminado correctamente.');
    }
}
