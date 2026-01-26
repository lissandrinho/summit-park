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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        // Relación con el Waiver (Opcional, o puedes guardar datos directos)
        // Por ahora lo haremos simple: guardamos el email para vincular
        $table->string('email_contact');

        // Detalles del Turno
        $table->date('date');           // Ej: 2023-10-25
        $table->string('time_slot');    // Ej: 14:00
        $table->integer('duration');    // Ej: 60 (minutos)
        $table->integer('jumpers');   // Cantidad de saltadores

        // Dinero
        $table->decimal('total_price', 10, 2);

        // Estado (Pendiente, Pagado, Cancelado)
        $table->string('status')->default('pending');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
