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
        Schema::create('gastos_indirectos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('monto', 10, 2);
            $table->integer('periodo_mes');
            $table->integer('periodo_anio');
            $table->integer('unidades_producidas')->default(1); // evita dividir por cero
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_indirectos');
    }
};
