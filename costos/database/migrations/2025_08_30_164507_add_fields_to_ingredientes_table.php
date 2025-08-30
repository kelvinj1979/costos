<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredientes', function (Blueprint $table) {
            // Eliminar la columna `unidad_medida`
           // $table->dropColumn('unidad_medida');
            
            // Agregar la nueva clave foránea `unidad_medida_id`
            $table->foreignId('unidad_medida_id')->constrained('unidades_medida');
            
            // Agregar la columna `densidad`
            $table->decimal('densidad', 10, 4)->nullable()->after('costo_unitario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredientes', function (Blueprint $table) {
            // Revertir los cambios en el orden inverso
            $table->dropForeign(['unidad_medida_id']);
            $table->dropColumn('unidad_medida_id');
            $table->dropColumn('densidad');
            
            // Si quieres, puedes recrear la columna original
            //$table->string('unidad_medida');
        });
    }
}