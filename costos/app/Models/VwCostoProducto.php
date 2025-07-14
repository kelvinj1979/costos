<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VwCostoProducto extends Model
{
    protected $table = 'vista_costos_productos';
    public $timestamps = false;

    // Opcional: Si usas fillable
    protected $fillable = [
        'producto_id',
        'nombre',
        'precio_venta',
        'porcentaje_utilidad',
        'costo',
        'ganancia',
        'ingredientes',
        'desechables',
        'mano_obra',
        'gastos_indirectos'
    ];

}
