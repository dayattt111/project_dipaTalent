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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('ipk_status', ['pending', 'valid', 'invalid'])->default('pending')->after('ipk');
            $table->timestamp('ipk_verified_at')->nullable()->after('ipk_status');
            $table->text('ipk_catatan_admin')->nullable()->after('ipk_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ipk_status', 'ipk_verified_at', 'ipk_catatan_admin']);
        });
    }
};
