<?php

namespace App\Http\Controllers;

use App\Models\Recetas;
use App\Models\Ingredientes;
use Illuminate\Http\Request;

class RecetasController extends Controller
{
    public function index()
    {
        $recetas = Recetas::with('ingredientes')->get();
        return view('pages.recetas', compact('recetas'));
    }

    public function create()
    {
        $ingredientes = Ingredientes::all();
        return view('pages.recetas_create', compact('ingredientes'));
    }

    public function store(Request $request)
    {
        $receta = Recetas::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'instrucciones' => $request->instrucciones,
        ]);

        foreach ($request->ingredientes as $detalle) {
            \DB::table('receta_detalle')->insert([
                'receta_id' => $receta->id,
                'ingrediente_id' => $detalle['id'],
                'unidad_medida' => $detalle['unidad_medida'],
                'cantidad' => $detalle['cantidad'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('recetas.index')->with('success', 'Receta creada correctamente');
    }

    public function edit(Recetas $receta)
    {
        $ingredientes = Ingredientes::all();
        $receta->load('ingredientes');
        return view('pages.recetas_edit', compact('receta', 'ingredientes'));
    }

    public function update(Request $request, Recetas $receta)
    {
        // 1. Actualiza los datos principales
        $receta->update($request->only('nombre', 'descripcion', 'instrucciones'));

        // 2. Elimina los detalles anteriores
        \DB::table('receta_detalle')->where('receta_id', $receta->id)->delete();

        // 3. Inserta los nuevos detalles
        foreach ($request->ingredientes as $detalle) {
            \DB::table('receta_detalle')->insert([
                'receta_id' => $receta->id,
                'ingrediente_id' => $detalle['id'],
                'unidad_medida' => $detalle['unidad_medida'],
                'cantidad' => $detalle['cantidad'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente');
    }

    public function destroy(Recetas $receta)
    {
        // Elimina los detalles asociados
        \DB::table('receta_detalle')->where('receta_id', $receta->id)->delete();

        // Elimina la receta (maestro)
        $receta->delete();

        return redirect()->route('recetas.index');
    }
}
