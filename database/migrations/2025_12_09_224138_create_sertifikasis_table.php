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
        Schema::create('sertifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_sertifikat');
            $table->string('penerbit'); // BNSP, Dicoding, Coursera, dll
            $table->string('jenis'); // BNSP, Bootcamp, Online Course, dll
            $table->string('nomor_sertifikat')->nullable();
            $table->date('tanggal_terbit');
            $table->date('tanggal_expired')->nullable();
            $table->string('bukti_file')->nullable(); // path file sertifikat
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->decimal('poin', 8, 2)->default(0); // poin yang didapat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasis');
    }
};
