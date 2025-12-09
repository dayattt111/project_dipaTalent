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
        Schema::table('skor_saw', function (Blueprint $table) {
            $table->decimal('nilai_akhir', 8, 4)->nullable()->after('total_skor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skor_saw', function (Blueprint $table) {
            $table->dropColumn('nilai_akhir');
        });
    }
};
