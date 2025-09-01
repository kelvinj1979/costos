<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadMedida; // Asegúrate de importar el modelo UnidadMedida

class UnidadMedidaController extends Controller
{
    //
    public function index()
    {
        $unidades = UnidadMedida::all();
        // Pasar las unidades a la vista
        return view('pages.unidad_medida', ['unidades' => $unidades]);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de unidades de medida
        return view('pages.create_unidad_medida');
    }

    public function store(Request $request)
    {
        // dd($request->all()); // Esto mostrará todos los datos enviados por el formulario
   
        $request->validate([
            'nombre' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
            'tipo' => 'required|string|max:100',
            'es_base' => 'required|boolean',
        ]);

        UnidadMedida::create([
            'nombre' => $request->nombre,
            'abreviatura' => $request->abreviatura,
            'tipo' => $request->tipo,
            'es_base' => $request->es_base,
        ]);

        return redirect()->route('unidad_medida.index')->with('success', 'Unidad de medida agregada correctamente.');
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
            'tipo' => 'required|string|max:100',
            'es_base' => 'required|boolean',
        ]);

        $unidad = UnidadMedida::findOrFail($id);
        $unidad->update([
            'nombre' => $request->nombre,
            'abreviatura' => $request->abreviatura,
            'tipo' => $request->tipo,
            'es_base' => $request->es_base,
        ]);

        return redirect()->route('unidad_medida.index')->with('success', 'Unidad de medida actualizada correctamente.');
    }   

    public function destroy($id)
    {
        $unidad = UnidadMedida::findOrFail($id);
        $unidad->delete();

        return redirect()->route('unidad_medida.index')->with('success', 'Unidad de medida eliminada correctamente.');
    }   
}
