<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos; 
use App\Models\Recetas; 
use App\Models\Materiales; 
use App\Models\Mdobra; 

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        return view('pages.productos', ['productos' => $productos]);
    }

    public function create()
    {
        $productos = Productos::all();
        $recetas = Recetas::all();
        $materiales = Materiales::all(); 
        $mobra = Mdobra::all(); 
        return view('pages.productos_create', compact('productos', 'recetas', 'materiales'));
    }

    public function store(Request $request)
    {
        $producto = Productos::create([
            'nombre' => $request->nombre,
            'porcentaje_utilidad' => $request->porcentaje_input ?? $request->porcentaje_select,
        ]);
        foreach ($request->recetas as $detalle) {
            \DB::table('producto_receta')->insert([
                'producto_id' => $producto->id,
                'receta_id' => $detalle['id'],
                'cantidad' => $detalle['cantidad'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }        

        foreach ($request->materiales as $detalle) {
            \DB::table('producto_desechables')->insert([
                'producto_id' => $producto->id,
                'desechable_id' => $detalle['id'],
                'cantidad' => $detalle['cantidad'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($request->mdobra as $mobra) {
            \DB::table('mano_obra')->insert([
                'producto_id' => $producto->id,
                'tiempo_minutos' => $mobra['tiempo_minutos'],
                'costo_por_hora' => $mobra['costo_por_hora'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Calcula y guarda el costo, precio y ganancia
        $this->calcularCostoTotal($producto);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $producto = Productos::findOrFail($id);
        $recetas = Recetas::all();
        $materiales = Materiales::all();
        $mobra = Mdobra::all(); 

        return view('pages.productos_edit', compact('producto', 'recetas', 'materiales', 'mobra'));
    }   

    public function update(Request $request, Productos $producto)
    {
        // 1. Actualiza los datos principales
        //$producto->update($request->only('nombre'));
        $porcentaje = $request->porcentaje_input ?: $request->porcentaje_select;

        $producto->update([
                'nombre' => $request->nombre,
                'porcentaje_utilidad' => $porcentaje,
            ]);

        // 2. Elimina los detalles anteriores
        \DB::table('producto_receta')->where('producto_id', $producto->id)->delete();
        \DB::table('producto_desechables')->where('producto_id', $producto->id)->delete();
      
        // 3. Inserta los nuevos detalles
        foreach ($request->recetas as $detalle) {
            \DB::table('producto_receta')->insert([
                'producto_id' => $producto->id,
                'receta_id' => $detalle['id'],
                'cantidad' => $detalle['cantidad'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($request->materiales as $detalle) {
            \DB::table('producto_desechables')->insert([
                'producto_id' => $producto->id,
                'desechable_id' => $detalle['id'],
                'cantidad' => $detalle['cantidad'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        
        // Actualiza o crea la mano de obra asociada
        foreach ($request->mdobra as $mobra) {
           \DB::table('mano_obra')->updateOrInsert(
                ['producto_id' => $producto->id],
                [
                    'tiempo_minutos' => $mobra['tiempo_minutos'],
                    'costo_por_hora' => $mobra['costo_por_hora'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );  
        }

        // 4. Calcula y guarda el costo, precio y ganancia
        $this->calcularCostoTotal($producto);

        return redirect()->route('productos.index')->with('success', 'Producto actualizada correctamente');
    }

    public function destroy(Productos $producto)
    {
        // Elimina los detalles asociados
        \DB::table('producto_receta')->where('producto_id', $producto->id)->delete();

        \DB::table('producto_desechables')->where('producto_id', $producto->id)->delete();

        // Elimina la mano de obra asociada
        if ($producto->manoObra) {
            $producto->manoObra()->delete();
        }

        // Elimina la producto (maestro)
        $producto->delete();

        return redirect()->route('productos.index');
    }
    
    public function calcularCostoTotal(Productos $producto)
    {
        $costoTotal = $producto->fresh(['recetas.ingredientes', 'materialesDesechables', 'manoObra'])->calcularCostoTotal();

        // Si no hay porcentaje, usa 40% por defecto
        $porcentaje = $producto->porcentaje_utilidad ?? 40;
        $factor = 1 + ($porcentaje / 100);

        $precioVenta = $costoTotal * $factor;
        $ganancia = $precioVenta - $costoTotal;

        $producto->update([
            'precio_venta' => $precioVenta,
            'costo' => $costoTotal,
            'ganancia' => $ganancia,
        ]);

        return redirect()->route('productos.index')->with('success', 'Costo total, precio y ganancia actualizados correctamente');
    }

}
