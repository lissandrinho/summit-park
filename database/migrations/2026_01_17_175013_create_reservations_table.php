<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Relaciones: Quién compró y Qué compró
            $table->foreignId('user_id')->constrained();
            $table->foreignId('package_id')->constrained();

            // Detalles de la visita
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->integer('quantity'); // Cuántas personas van
            $table->decimal('total_price', 10, 2); // Precio final pagado

            // Estado (Pendiente, Confirmado, Cancelado)
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('confirmed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};