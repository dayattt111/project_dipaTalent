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
        Schema::table('prestasis', function (Blueprint $table) {
            $table->date('tanggal_pencapaian')->nullable()->after('deskripsi');
            $table->string('penyelenggara')->nullable()->after('tanggal_pencapaian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropColumn(['tanggal_pencapaian', 'penyelenggara']);
        });
    }
};
