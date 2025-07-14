<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('unidad_medida');
            $table->decimal('costo_unitario', 10, 2);
            $table->date('fecha_actualizacion')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredientes');
    }
};
