<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Tabel Beasiswa
        Schema::create('beasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_beasiswa');
            $table->text('deskripsi')->nullable();
            $table->integer('kuota')->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'nonaktif', 'ditutup'])->default('aktif');
            $table->timestamps();
        });

        // 2. Pendaftaran Beasiswa (relasi mahasiswa)
        Schema::create('pendaftaran_beasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('beasiswa_id')->constrained('beasiswas')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 3. Dokumen Beasiswa
        Schema::create('dokumen_beasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_beasiswas')->onDelete('cascade');
            $table->string('jenis_dokumen');
            $table->string('path_file');
            $table->timestamps();
        });

        // 4. Prestasi Mahasiswa
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('jenis', ['akademik', 'non-akademik']);
            $table->string('nama_prestasi');
            $table->string('tingkat')->nullable(); // lokal, nasional, internasional
            $table->integer('tahun')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->enum('status', ['menunggu', 'valid', 'invalid'])->default('menunggu');
            $table->timestamps();
        });

        // 5. Bobot Kriteria (SAW)
        Schema::create('bobot_kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria');
            $table->decimal('bobot', 5, 2);
            $table->enum('tipe', ['benefit', 'cost'])->default('benefit');
            $table->timestamps();
        });

        // 6. Normalisasi SAW
        Schema::create('normalisasi_saw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestasi_id')->constrained('prestasis')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('bobot_kriterias')->onDelete('cascade');
            $table->decimal('nilai_normalisasi', 8, 4);
            $table->timestamps();
        });

        // 7. Skor SAW
        Schema::create('skor_saw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_skor', 8, 4)->default(0);
            $table->timestamps();
        });

        // 8. Leaderboard (hasil ranking SAW)
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('skor_id')->constrained('skor_saw')->onDelete('cascade');
            $table->integer('peringkat')->default(0);
            $table->timestamps();
        });

        // 9. Galeri Prestasi
        Schema::create('galeri_prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestasi_id')->constrained('prestasis')->onDelete('cascade');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // 10. Laporan Beasiswa
        Schema::create('laporan_beasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('beasiswa_id')->constrained('beasiswas')->onDelete('cascade');
            $table->integer('total_pendaftar')->default(0);
            $table->integer('total_diterima')->default(0);
            $table->integer('total_ditolak')->default(0);
            $table->timestamps();
        });

        // 11. Laporan Prestasi
        Schema::create('laporan_prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_prestasi_valid')->default(0);
            $table->integer('total_mahasiswa')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_prestasis');
        Schema::dropIfExists('laporan_beasiswas');
        Schema::dropIfExists('galeri_prestasis');
        Schema::dropIfExists('leaderboards');
        Schema::dropIfExists('skor_saw');
        Schema::dropIfExists('normalisasi_saw');
        Schema::dropIfExists('bobot_kriterias');
        Schema::dropIfExists('prestasis');
        Schema::dropIfExists('dokumen_beasiswas');
        Schema::dropIfExists('pendaftaran_beasiswas');
        Schema::dropIfExists('beasiswas');
    }
};
