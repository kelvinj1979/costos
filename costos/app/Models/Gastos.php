<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = 'gastos_indirectos';
    protected $fillable = ['descripcion', 'monto', 'periodo_mes', 'periodo_anio', 'unidades_producidas'];

    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'fecha_actualizacion' => 'datetime',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    

}
