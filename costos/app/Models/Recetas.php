<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredientes;
use App\Models\Productos;

class Recetas extends Model
{
    protected $table = 'recetas';
   
    protected $fillable = ['nombre', 'descripcion', 'instrucciones'];

    public function ingredientes()
    {
        return $this->belongsToMany(Ingredientes::class, 'receta_detalle', 'receta_id', 'ingrediente_id')
                    ->withPivot('cantidad','unidad_medida')
                    ->withTimestamps();
    }

    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'producto_receta')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
