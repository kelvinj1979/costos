<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiales extends Model
{
    protected $table = 'materiales_desechables';
    protected $fillable = ['nombre', 'costo_unitario'];

    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'producto_desechables', 'desechable_id', 'producto_id')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
