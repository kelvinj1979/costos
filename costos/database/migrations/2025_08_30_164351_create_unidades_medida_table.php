<?php

// database/migrations/2025_01_01_000001_create_unidades_medida_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('unidades_medida', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('abreviatura', 10);
            $table->enum('tipo', ['peso', 'volumen', 'unidad']);
            $table->boolean('es_base')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('unidades_medida');
    }
};
