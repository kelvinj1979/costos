<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiales; // Asegúrate de importar el modelo Materiales

class MaterialesController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los materiales
        // Por ejemplo, podrías usar un modelo para obtener los datos de la base de datos
        // return Materiales::all();
        $materiales =  Materiales::all(); // Reemplaza esto con tu lógica para obtener los materiales

        return view('pages.materiales', ['materiales' => $materiales]);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de materiales
        return view('pages.create_material');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo_unitario' => 'required|numeric|min:0',
        ]);

        Materiales::create([
            'nombre' => $request->nombre,
            'costo_unitario' => $request->costo_unitario,
        ]);

        return redirect()->route('materiales.index')->with('success', 'Material agregado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo_unitario' => 'required|numeric|min:0',
        ]);

        $material = Materiales::findOrFail($id);
        $material->update([
            'nombre' => $request->nombre,
            'costo_unitario' => $request->costo_unitario,
        ]);

        return redirect()->route('materiales.index')->with('success', 'Material actualizado correctamente.');
    }   

    public function destroy($id)
    {
        $material = Materiales::findOrFail($id);
        $material->delete();

        return redirect()->route('materiales.index')->with('success', 'Material eliminado correctamente.');
    }
}
