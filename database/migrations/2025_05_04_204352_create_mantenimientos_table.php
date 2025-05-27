<?php

use App\Models\Detalles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('mantenimientos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('fk_id_mecanico');
      $table->unsignedBigInteger('fk_id_maquina');
      $table->date('fecha_mantenimiento');
      $table->enum('tipo_mantenimiento', ['preventivo', 'correctivo', 'predictivo']);
      $table->decimal('costo_total', 10, 2)->nullable();
      $table->timestamps();
    });
  }
  public function down(): void
  {
    Schema::dropIfExists('mantenimientos');
  }
};
