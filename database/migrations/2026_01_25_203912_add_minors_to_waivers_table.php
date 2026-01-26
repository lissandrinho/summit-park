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
    Schema::table('waivers', function (Blueprint $table) {
        // Guardaremos un array de nombres: ["Juan", "Sofía"]
        $table->json('minors')->nullable()->after('document_id');
        // Relacionamos el waiver con una reserva específica
        $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('waivers', function (Blueprint $table) {
            //
        });
    }
};
