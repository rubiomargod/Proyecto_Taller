<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('mecanicos', function (Blueprint $table) {
      $table->id('id');
      $table->string('nombres');
      $table->string('apellidos');
      $table->string('correo')->unique();
      $table->string('telefono')->nullable();
      $table->string('direccion')->nullable();
      $table->string('ine')->nullable();
      $table->string('estatus')->default("Activo");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('mecanicos');
  }
};
