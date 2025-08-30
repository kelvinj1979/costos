<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recetas;
use App\Models\UnidadMedida; // Asegúrate de que este sea el namespace correcto

class Ingredientes extends Model
{
    //
    protected $table = 'ingredientes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'fecha_actualizacion' => 'datetime',
    ];
 
    protected $fillable = ['nombre', 'unidad_medida_id', 'costo_unitario',  'densidad', 'fecha_actualizacion'];
    protected $hidden = ['created_at', 'updated_at'];

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
    }

    public function recetas()
    {
        return $this->belongsToMany(Recetas::class, 'receta_detalle')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }


}
