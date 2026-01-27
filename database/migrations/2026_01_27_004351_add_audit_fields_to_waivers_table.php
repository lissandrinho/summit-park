<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('waivers', function (Blueprint $table) {
            // Verificamos si no existen para agregarlos
            if (!Schema::hasColumn('waivers', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('signature');
            }
            if (!Schema::hasColumn('waivers', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('waivers', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent']);
        });
    }
};