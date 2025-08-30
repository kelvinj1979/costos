<?php
// database/migrations/2025_08_30_164449_create_conversiones_unidades_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionesUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('conversiones_unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unidad_id')->constrained('unidades_medida')->onDelete('cascade');
            $table->foreignId('unidad_base_id')->constrained('unidades_medida')->onDelete('cascade');
            $table->decimal('factor', 12, 6);
            $table->timestamps();
            
            $table->unique(['unidad_id', 'unidad_base_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('conversiones_unidades');
    }
}