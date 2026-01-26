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
         Schema::create('activities', function (Blueprint $table) {
                $table->id();
                $table->string('name');      // Ej: "Pase 1 Hora"
                $table->integer('duration'); // Ej: 60
                $table->decimal('price', 10, 2); // Ej: 400.00
                $table->boolean('active')->default(true); // <--- ESTA ES LA COLUMNA QUE TE FALTABA
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
