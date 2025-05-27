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
    Schema::create('detalles', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('fk_id_mantenimiento');
      $table->unsignedBigInteger('fk_id_pieza'); // Clave foránea
      $table->text('detalle');
      $table->decimal('costo', 10, 2);
      $table->timestamps();

      $table->foreign('fk_id_mantenimiento')->references('id')->on('mantenimientos')->onDelete('cascade');
    });
  }
  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('detalles');
  }
};
