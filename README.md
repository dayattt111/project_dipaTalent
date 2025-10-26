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