<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gastos; // Asegúrate de importar el modelo Gastos

class GastosController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los gastos
        // Por ejemplo, podrías usar un modelo para obtener los datos de la base de datos
        // return Gastos::all(); 
        //`id`, `descripcion`, `monto`, `periodo_mes`, `periodo_anio`, `unidades_producidas` campos de DB
                             
        $Gastos = Gastos::all();
        
        // Para este ejemplo, simplemente retornamos una vista
        return view('pages.gastos', ['gastos' => $Gastos]);
    }  

    public function store(Request $request)
    {
        // Lógica para almacenar un nuevo gasto
        // Validar y guardar el gasto en la base de datos
        request()->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'periodo_mes' => 'required|integer|min:1|max:12',
            'periodo_anio' => 'required|integer|min:2000|max:2100',
            'unidades_producidas' => 'nullable|integer|min:0',
        ]);

        Gastos::create([
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'periodo_mes' => $request->periodo_mes,
            'periodo_anio' => $request->periodo_anio,
            'unidades_producidas' => $request->unidades_producidas,
        ]);
        return redirect()->route('gastos.index')->with('success', 'Gasto agregado correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un gasto existente
        request()->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'periodo_mes' => 'required|integer|min:1|max:12',
            'periodo_anio' => 'required|integer|min:2000|max:2100',
            'unidades_producidas' => 'nullable|integer|min:0',
        ]);

        $gasto = Gastos::findOrFail($id);
        $gasto->update([
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'periodo_mes' => $request->periodo_mes,
            'periodo_anio' => $request->periodo_anio,
            'unidades_producidas' => $request->unidades_producidas,
        ]);
        
        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado correctamente.');
    }   

    public function destroy($id)
    {
        // Lógica para eliminar un gasto
        $gasto = Gastos::findOrFail($id);
        $gasto->delete();

        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado correctamente.');
    }

}
