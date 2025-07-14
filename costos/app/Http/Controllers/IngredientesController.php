<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredientes; // Asegúrate de importar el modelo Ingredientes

class IngredientesController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los ingredientes
        // Por ejemplo, podrías usar un modelo para obtener los datos de la base de datos
        // return Ingredientes::all();
        $Ingredientes = Ingredientes::all();

        return view('pages.ingredientes', ['ingredientes' => $Ingredientes]);

        // Si necesitas retornar una respuesta JSON, puedes hacer lo siguiente:
        // return response()->json($Ingredientes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:50',
            'costo_unitario' => 'required|numeric|min:0',
        ]);

        Ingredientes::create([
            'nombre' => $request->nombre,
            'unidad_medida' => $request->unidad_medida,
            'costo_unitario' => $request->costo_unitario,
        ]);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente agregado correctamente.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:50',
            'costo_unitario' => 'required|numeric|min:0',
        ]);

        $ingrediente = Ingredientes::findOrFail($id);
        $ingrediente->update([
            'nombre' => $request->nombre,
            'unidad_medida' => $request->unidad_medida,
            'costo_unitario' => $request->costo_unitario,
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
