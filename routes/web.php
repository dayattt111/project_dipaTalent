<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ===============================
// Halaman Welcome
// ===============================
Route::get('/', function () {
    return view('welcome');
});


// ===============================
// ROUTE ADMIN (auth + verified + prefix admin)
// ===============================
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])
        ->name('dashboard');

    // ===============================
    // VERIFIKASI PENDAFTAR
    // ===============================
    Route::get('/verifikasi-pendaftar', [BeasiswaController::class, 'index'])
        ->name('verifikasiPendaftar.index');

    Route::get('/verifikasi-pendaftaran/{id}', [BeasiswaController::class, 'showVerifikasi'])
        ->name('verifikasiPendaftar.form');

    Route::post('/verifikasi-pendaftaran/{id}', [BeasiswaController::class, 'verifikasi'])
        ->name('verifikasiPendaftar.verifikasi');

    Route::post('/verifikasi/{id}', [BeasiswaController::class, 'verifikasi'])
        ->name('verifikasiPendaftar.verifikasi2'); // opsi kedua

    Route::post('/verifikasi/{id}/update', [BeasiswaController::class, 'update'])
        ->name('verifikasiPendaftar.update');

    Route::post('/verifikasi/{id}/batal', [BeasiswaController::class, 'batal'])
        ->name('verifikasiPendaftar.batal');

    // Ambil data user
    Route::get('/get-user/{id}', function ($id) {
        $user = \App\Models\User::find($id);
        return response()->json([
            'nim' => $user->nim ?? null,
        ]);
    })->name('getUser');

    // ===============================
    // CRUD PENDAFTAR
    // ===============================
    Route::get('/pendaftaran/create', [BeasiswaController::class, 'create'])
        ->name('pendaftaran.create');

    Route::post('/pendaftaran/store', [BeasiswaController::class, 'store'])
        ->name('pendaftaran.store');

    Route::delete('/pendaftaran/delete/{id}', [BeasiswaController::class, 'destroy'])
        ->name('pendaftaran.delete');

    // ===============================
    // KELOLA BEASISWA
    // ===============================
    Route::get('/kelola-beasiswa', fn() => view('admin.kelolaBeasiswa.index'))
        ->name('kelolaBeasiswa.index');

    Route::get('/kelola-beasiswa/atur-bobot', fn() => view('admin.kelolaBeasiswa.aturBobot'))
        ->name('kelolaBeasiswa.aturBobot');

    Route::get('/kelola-beasiswa/data', fn() => view('admin.kelolaBeasiswa.data'))
        ->name('kelolaBeasiswa.data');

    // ===============================
    // VERIFIKASI PRESTASI
    // ===============================
    Route::get('/verifikasi-prestasi', [PrestasiController::class, 'index'])
        ->name('verifikasiPrestasi.index');

    Route::get('/verifikasi-prestasi/create', [PrestasiController::class, 'create'])
        ->name('verifikasiPrestasi.create');

    Route::post('/verifikasi-prestasi/store', [PrestasiController::class, 'store'])
        ->name('verifikasiPrestasi.store');

    Route::get('/verifikasi-prestasi/{id}/edit', [PrestasiController::class, 'edit'])
        ->name('verifikasiPrestasi.edit');

    Route::post('/verifikasi-prestasi/{id}/update-status', [PrestasiController::class, 'updateStatus'])
        ->name('verifikasiPrestasi.updateStatus');
    Route::put('/verifikasi-prestasi/{id}/update-status', [PrestasiController::class, 'updateStatus'])
        ->name('verifikasiPrestasi.updateStatus');

    Route::delete('/verifikasi-prestasi/{id}/delete', [PrestasiController::class, 'destroy'])
        ->name('verifikasiPrestasi.destroy');

    Route::get('/verifikasi-prestasi/{id}/bukti', [PrestasiController::class, 'showBukti'])
        ->name('verifikasiPrestasi.bukti');

    // ===============================
    // METODE SAW
    // ===============================
    Route::get('/metode', fn() => view('admin.metode.index'))
        ->name('metode.index');

    Route::get('/metode/data', fn() => view('admin.metode.data'))
        ->name('metode.data');

    Route::get('/metode/skot-saw', fn() => view('admin.metode.skotSaw'))
        ->name('metode.skotSaw');

    // ===============================
    // LAPORAN
    // ===============================
    Route::get('/laporan', fn() => view('admin.laporan.index'))
        ->name('laporan.index');
});


// ===============================
// ROUTE MAHASISWA DAN UMUM
// ===============================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/umum/dashboard', function () {
        return view('umum.dashboard');
    })->name('umum.dashboard');
});


// ===============================
// PROFILE
// ===============================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ===============================
// VERIFIKASI EMAIL
// ===============================
Route::get('/email/verify', fn() => view('auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])
  ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');


// ===============================
// REDIRECT DASHBOARD UTAMA
// ===============================
Route::get('/dashboard', function () {
    $user = Auth::user();
    return match ($user->role) {
        'admin'     => redirect()->route('admin.dashboard'),
        'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
        default     => redirect()->route('umum.dashboard'),
    };
})->middleware(['auth', 'verified'])
  ->name('dashboard');


// Auth Routes
require __DIR__.'/auth.php';
