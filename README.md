# DipaTalent Project

A Laravel-based scholarship (beasiswa) and achievement (prestasi) management system for mahasiswa.

Fitur utama:
- Kelola beasiswa (CRUD) — daftar beasiswa, atur kuota dan periode
- Verifikasi pendaftaran beasiswa oleh admin (approve/reject)
- Verifikasi prestasi mahasiswa (review sertifikat)
- Pengaturan bobot SAW (Simple Additive Weighting) dan perhitungan normalisasi + skor
- Laporan yang dapat difilter berdasarkan rentang waktu dan diekspor ke PDF
- Kelola pengguna (admin dapat membuat, mengedit, dan menghapus akun)

Catatan singkat perubahan yang telah dibuat:
- Perbaikan `User` model: menambahkan `role` dan `nim` pada `$fillable`, memperbaiki properti `$casts`, dan menambahkan helper `isAdmin()`.
- Menambahkan migration untuk kolom `nim` di tabel `users` (`database/migrations/2025_11_27_000000_add_nim_to_users_table.php`).
- Menambahkan middleware `EnsureUserIsAdmin` di `app/Http/Middleware/EnsureUserIsAdmin.php` dan menggunakannya pada group route `admin`.
- Menambahkan controller `Admin\UserController` dengan CRUD dan view blade di `resources/views/admin/users/*`.
- Menambahkan method `store` pada `Admin\SawController` (pembuatan bobot kriteria) agar form `/bobot-saw/store` berfungsi.

Persyaratan
- PHP >= 8.0
- Composer
- MySQL (atau database lain yang didukung Laravel)
- Node.js & npm (untuk asset build dengan Vite/Tailwind)

Setup lokal (Windows PowerShell)

1. Salin file `.env.example` ke `.env` dan atur kredensial database serta `APP_URL`.

```powershell
copy .env.example .env
php artisan key:generate
```

2. Instal dependensi PHP dan JS

```powershell
composer install
npm install
npm run build
```

3. Jalankan migration dan seeder (jika ingin data contoh)

```powershell
php artisan migrate
php artisan db:seed
```

4. Jika menggunakan storage publik (untuk file prestasi), jalankan:

```powershell
php artisan storage:link
```

5. Jalankan server lokal

```powershell
php artisan serve
```

PDF Export
- Saya merekomendasikan paket `barryvdh/laravel-dompdf` untuk export PDF server-side.
- Untuk memasang:

```powershell
composer require barryvdh/laravel-dompdf
```

- Setelah terpasang, Anda dapat membuat controller action yang memanggil view laporan dan mengembalikannya sebagai PDF, misal:

```php
use Barryvdh\DomPDF\Facade\Pdf;

public function exportReport(Request $req) {
    $data = /* ambil data filter */;
    $pdf = Pdf::loadView('admin.laporan.pdf', compact('data'));
    return $pdf->download('laporan.pdf');
}
```

Catatan penting dan langkah lanjut
- Pastikan tabel `users` memiliki kolom `nim`. Saya menambahkan migration yang menambah kolom ini; jalankan `php artisan migrate`.
- Saya menambahkan middleware `EnsureUserIsAdmin`. Routes admin sekarang menggunakan kelas middleware tersebut; pastikan user yang login memiliki `role = 'admin'`.
- Beberapa view admin sudah ada di `resources/views/admin/*`. Saya menambahkan tampilan dasar untuk `admin/users`.
- Untuk menyelesaikan semua fitur (polish UI, cetak laporan PDF dengan filter tanggal, kelola beasiswa lengkap, penanganan file yang lebih baik, notifikasi), saya sarankan langkah bertahap yang terprioritaskan — saya bisa lanjutkan implementasinya satu per satu.

Cara saya bisa terus bekerja (opsional):
- Implementasi lengkap CRUD Beasiswa dan view yang lebih profesional
- Lengkapi laporan: endpoint filter tanggal, layout laporan, dan tombol ekspor PDF
- Perbaikan UI/UX pada halaman verifikasi pendaftaran dan prestasi
- Menambahkan test feature untuk alur verifikasi

Jika mau, saya akan lanjutkan mengimplementasikan satu fitur setelah konfirmasi Anda (mis. lengkapkan Kelola Beasiswa, lalu laporan PDF).

---
Jika ada preferensi styling atau fitur tambahan (mis. integrasi email notifikasi, role granular, atau single-sign-on), beri tahu saya dan saya integrasikan.
Proyek DipaTalent

Selamat datang di Proyek DipaTalent. Ini adalah sistem informasi yang dibangun menggunakan Laravel 12, Breeze, dan Tailwind CSS, yang dirancang untuk mengelola data talenta dengan sistem autentikasi dan peran pengguna yang berbeda.

Tentang Proyek

DipaTalent adalah sebuah platform sistem informasi yang bertujuan untuk mengelola dan memamerkan data talenta, kemungkinan besar di lingkungan akademik atau organisasi. Proyek ini mencakup autentikasi pengguna yang aman dan dashboard yang berbeda berdasarkan peran pengguna (Admin, Mahasiswa, dan Umum), memungkinkan fungsionalitas yang disesuaikan untuk setiap jenis pengguna.

Fitur Utama

Autentikasi Lengkap: Proses registrasi, login, dan reset password yang aman menggunakan Laravel Breeze.

Berbasis Peran (Role-Based): Tampilan dashboard yang berbeda untuk:

Admin: Untuk mengelola data master, pengguna, dan konten.

Mahasiswa: Untuk melihat informasi akademik, profil, dll.

Umum: Tampilan dashboard standar untuk pengguna terdaftar.

Frontend Modern: Dibangun dengan Blade dan Tailwind CSS, dikompilasi menggunakan Vite.

Struktur Proyek Bersih: Mengikuti praktik terbaik Laravel untuk kemudahan pemeliharaan.

Teknologi yang Digunakan

Backend: PHP 8.2+ / Laravel 12

Frontend: Blade, Tailwind CSS, Alpine.js

Kompilasi Aset: Vite

Autentikasi: Laravel Breeze

Database: MySQL (default) / PostgreSQL (opsional)

Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1. Clone Repository

git clone [https://github.com/dayattt111/project_dipaTalent.git](https://github.com/dayattt111/project_dipaTalent.git)
cd project_dipaTalent


2. Instal Dependensi Backend

Pastikan Anda memiliki Composer terinstal.

composer install


3. Siapkan File Environment (.env)

Salin file .env.example dan buat file .env baru.

cp .env.example .env


4. Buat Kunci Aplikasi (App Key)

php artisan key:generate


5. Konfigurasi Database

Buka file .env dan atur koneksi database Anda (buat database baru di MySQL/phpMyAdmin dengan nama dipa_talent atau sesuai keinginan Anda).

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dipa_talent
DB_USERNAME=root
DB_PASSWORD=


6. Jalankan Migrasi Database

Perintah ini akan membuat semua tabel yang diperlukan di database Anda.

php artisan migrate


7. Instal Dependensi Frontend

Pastikan Anda memiliki Node.js (termasuk npm) terinstal.

npm install


Cara Menjalankan Proyek

Anda perlu menjalankan dua server secara bersamaan di dua terminal terpisah.

Terminal 1: Jalankan Server Laravel

php artisan serve


Terminal 2: Jalankan Server Vite (Compile Aset)

npm run dev


Setelah kedua server berjalan, buka aplikasi di browser Anda:
http://127.0.0.1:8000

Lisensi

Proyek ini berada di bawah Lisensi MIT.