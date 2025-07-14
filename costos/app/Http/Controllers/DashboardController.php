<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\VwCostoProducto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Productos::count();
        $resumenCostos = VwCostoProducto::all();

        $productos = Productos::all()->map(function ($producto) {
            $costoTotal = $producto->costo; // Usa el valor guardado
            $ganancia = $producto->precio_venta - $costoTotal;
            $margen = $producto->precio_venta > 0 ? ($ganancia / $producto->precio_venta) * 100 : 0;
            

            return (object) [
                'nombre' => $producto->nombre,
                'costo_total' => $costoTotal,
                'precio_venta' => $producto->precio_venta,
                'ganancia' => $ganancia,
                'margen' => $margen,
            ];
        });

        $margenPromedio = $productos->avg('margen');

        $productosTop = $productos->sortByDesc('margen')->take(5);

        $productosBajoMargen = $productos->filter(function ($p) {
            return $p->margen < 10;
        });
    

        // Inicializar variables de costos en base al total de productos
        $costoIngredientes = 0;
        $costoManoObra = 0;
        $costoMaterialDesechable = 0;
        $costoGastosIndirectos = 0;
        $costoTotal = 0;

        foreach (Productos::all() as $producto) {
            $service = new Productos();
            $costos = $producto->desgloseCostos(); // Este método debe devolver un array con los costos
            $costoIngredientes += $costos['ingredientes'] ?? 0;
            $costoManoObra += $costos['mano_obra'] ?? 0;
            $costoMaterialDesechable += $costos['material_desechable'] ?? 0;
            $costoGastosIndirectos += $costos['gastos_indirectos'] ?? 0;
            $costoTotal += $service->calcularCosto($producto);
        }

        // Evitar división por cero
        if ($costoTotal > 0) {
            $ingredientes = $costoIngredientes * 100 / $costoTotal;
            $manoObra = $costoManoObra * 100 / $costoTotal;
            $materialDesechable = $costoMaterialDesechable * 100 / $costoTotal;
            $gastosIndirectos = $costoGastosIndirectos * 100 / $costoTotal;
        } else {
            $ingredientes = $manoObra = $materialDesechable = $gastosIndirectos = 0;
        }

        $distribucionCostos = [
            'ingredientes' => $ingredientes,
            'mano_obra' => $manoObra,
            'material_desechable' => $materialDesechable,
            'gastos_indirectos' => $gastosIndirectos,
        ];

        return view('pages.dashboard', compact(
            'totalProductos',
            'margenPromedio',
            'productosTop',
            'productosBajoMargen',
            'distribucionCostos' ,
            'resumenCostos'
        ));
    }
}
