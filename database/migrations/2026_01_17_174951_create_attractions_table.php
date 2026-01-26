<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Ej: "Pista Ninja"
            $table->text('description'); // Descripción para convencer a Thiago
            $table->string('image_path')->nullable(); // Foto de la atracción
            $table->string('video_url')->nullable(); // Video de YouTube/TikTok
            $table->string('min_height')->nullable(); // Ej: "1.20m" (Info útil para padres)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};