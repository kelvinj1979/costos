<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mdobra extends Model
{
    protected $table = 'mano_obra';

    protected $fillable = ['producto_id', 'tiempo_minutos', 'costo_por_hora'];

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }
}
