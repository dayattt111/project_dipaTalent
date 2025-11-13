<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke tabel users
            $table->foreignId('beasiswa_id')->constrained()->onDelete('cascade'); // relasi ke tabel beasiswas
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('prestasi')->nullable();
            $table->string('organisasi')->nullable();
            $table->string('keterampilan')->nullable();
            $table->string('transkrip')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
