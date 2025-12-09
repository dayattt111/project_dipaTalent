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
        Schema::create('organisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_organisasi');
            $table->string('jabatan');
            $table->string('periode'); // contoh: 2023-2024
            $table->text('deskripsi')->nullable();
            $table->string('bukti_file')->nullable(); // path file bukti
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
        Schema::dropIfExists('organisasis');
    }
};
