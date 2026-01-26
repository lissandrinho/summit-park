<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('waivers', function (Blueprint $table) {
        $table->id();
        
        // Datos del Responsable
        $table->string('full_name');
        $table->string('document_id'); // Cédula
        $table->string('email');
        $table->string('phone');
        $table->date('birth_date');

        // Datos del Menor
        $table->boolean('signing_for_minor')->default(false);
        $table->string('minor_name')->nullable();
        $table->date('minor_birth_date')->nullable();
        $table->string('minor_document_id')->nullable();
        // Datos Legales
        $table->longText('signature'); // La firma es una imagen base64 larga
        $table->boolean('terms_accepted')->default(false);
        $table->ipAddress('ip_address')->nullable(); // Bueno para auditoría legal

        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('waivers');
    }
};