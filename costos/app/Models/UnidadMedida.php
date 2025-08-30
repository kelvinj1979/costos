<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'unidades_medida';
    protected $fillable = ['nombre', 'abreviatura', 'tipo', 'es_base'];

    public function ingredientes()
    {
        return $this->hasMany(Ingredientes::class, 'unidad_medida_id');
    }

    public function conversiones()
    {
        return $this->hasMany(ConversionUnidad::class, 'unidad_id');
    }
}