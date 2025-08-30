<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionUnidad extends Model
{
    use HasFactory;

    protected $table = 'conversiones_unidades';
    protected $fillable = ['unidad_id', 'unidad_base_id', 'factor'];
}
