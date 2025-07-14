<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
     protected $fillable = ['nombre','porcentaje_utilidad', 'precio_venta', 'costo', 'ganancia'];

    public function recetas()
    {
        return $this->belongsToMany(Recetas::class, 'producto_receta', 'producto_id', 'receta_id')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    public function materialesDesechables()
    {
        return $this->belongsToMany(Materiales::class, 'producto_desechables', 'producto_id', 'desechable_id')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    public function manoObra()
    {
        return $this->hasOne(Mdobra::class, 'producto_id');
    }
    public function calcularCostoTotal()
    {
        $costoIngredientes = 0;

        foreach ($this->recetas as $productoReceta) {
            $receta = $productoReceta;
            $cantidadReceta = $productoReceta->pivot->cantidad;

            foreach ($receta->ingredientes as $ingrediente) {
                $costoUnidad = $ingrediente->costo_unitario;
                $unidadDefault = $ingrediente->unidad_medida;
                $unidadUsada = $ingrediente->pivot->unidad_medida;
                $cantidadUsada = $ingrediente->pivot->cantidad * $cantidadReceta;

                // Si la unidad usada es diferente a la default, buscar conversión
                if ($unidadUsada && $unidadUsada !== $unidadDefault) {
                    $conversion = \DB::table('tabla_conversion')
                        ->where('unidad_desde', $unidadUsada)
                        ->where('unidad_hasta', $unidadDefault)
                        ->first();

                    if ($conversion) {
                        // Convertir la cantidad usada a la unidad default del ingrediente
                        $cantidadUsada = $cantidadUsada * $conversion->valor;
                    } else {
                        // Si no existe conversión, puedes lanzar una excepción o loguear
                        throw new \Exception("No existe conversión de $unidadUsada a $unidadDefault para el ingrediente '{$ingrediente->nombre}' en la receta '{$receta->nombre}'.");
                    }
                }

                $costoIngredientes += $costoUnidad * $cantidadUsada;
            }
        }

        // Mano de obra
        $costoManoObra = 0;
        if ($this->manoObra) {
            $minutos = $this->manoObra->tiempo_minutos;
            $costoHora = $this->manoObra->costo_por_hora;
            $costoManoObra = ($minutos / 60) * $costoHora;
        }

         // Desechables
        $costoDesechables = $this->materialesDesechables->sum(function ($d) {
            return $d->costo_unitario * $d->pivot->cantidad;
        });

        // Gastos indirectos prorrateados por unidad
        $costoIndirecto = Gastos::all()->sum(function ($gasto) {
            return $gasto->unidades_producidas > 0
                ? $gasto->monto / $gasto->unidades_producidas
                : 0;
        });

        // Suma total
        return round($costoIngredientes + $costoManoObra + $costoDesechables + $costoIndirecto, 2);

    }

    public function calcularCosto(Productos $producto): float
    {
        $producto->loadMissing(['recetas.ingredientes', 'materialesDesechables', 'manoObra']);

        // Ingredientes por receta
        $costoIngredientes = 0;
        foreach ($producto->recetas as $productoReceta) {
            $cantidadReceta = $productoReceta->pivot->cantidad;

            foreach ($productoReceta->ingredientes as $ingrediente) {
                $costoUnidad = $ingrediente->costo_unitario;
                $cantidadUsada = $ingrediente->pivot->cantidad * $cantidadReceta;
                $costoIngredientes += $costoUnidad * $cantidadUsada;
            }
        }

        // Mano de obra
        $costoManoObra = 0;
        if ($producto->manoObra) {
            $minutos = $producto->manoObra->tiempo_minutos;
            $costoHora = $producto->manoObra->costo_por_hora;
            $costoManoObra = ($minutos / 60) * $costoHora;
        }

        // Desechables
        $costoDesechables = $producto->materialesDesechables->sum(function ($d) {
            return $d->costo_unitario * $d->pivot->cantidad;
        });

        // Gastos indirectos prorrateados
        $costoIndirecto = Gastos::all()->sum(function ($gasto) {
            return $gasto->unidades_producidas > 0
                ? $gasto->monto / $gasto->unidades_producidas
                : 0;
        });

        return round($costoIngredientes + $costoManoObra + $costoDesechables + $costoIndirecto, 2);
    }

    public function show($id)
{
    $producto = Productos::findOrFail($id);
    $costoService = new Productos();
    $costoTotal = $costoService->calcularCosto($producto);

    return view('productos.show', compact('producto', 'costoTotal'));
}

public function desgloseCostos()
{
    // Calcula los costos individuales
    $costoIngredientes = 0;
    $costoManoObra = 0;
    $costoMaterialDesechable = 0;
    $costoGastosIndirectos = 0;

    // Ingredientes
    foreach ($this->recetas as $productoReceta) {
        $cantidadReceta = $productoReceta->pivot->cantidad;
        foreach ($productoReceta->ingredientes as $ingrediente) {
            $costoUnidad = $ingrediente->costo_unitario;
            $cantidadUsada = $ingrediente->pivot->cantidad * $cantidadReceta;
            $costoIngredientes += $costoUnidad * $cantidadUsada;
        }
    }

    // Mano de obra
    if ($this->manoObra) {
        $minutos = $this->manoObra->tiempo_minutos;
        $costoHora = $this->manoObra->costo_por_hora;
        $costoManoObra = ($minutos / 60) * $costoHora;
    }

    // Material desechable
    $costoMaterialDesechable = $this->materialesDesechables->sum(function ($d) {
        return $d->costo_unitario * $d->pivot->cantidad;
    });

    // Gastos indirectos
    $costoGastosIndirectos = \App\Models\Gastos::all()->sum(function ($gasto) {
        return $gasto->unidades_producidas > 0
            ? $gasto->monto / $gasto->unidades_producidas
            : 0;
    });

    return [
        'ingredientes' => $costoIngredientes,
        'mano_obra' => $costoManoObra,
        'material_desechable' => $costoMaterialDesechable,
        'gastos_indirectos' => $costoGastosIndirectos,
    ];
}
}

