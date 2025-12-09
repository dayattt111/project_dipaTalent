<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\sawController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController;
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
Route::middleware(['auth', 'verified', \App\Http\Middleware\EnsureUserIsAdmin::class])
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
    Route::get('/kelola-beasiswa', [BeasiswaController::class, 'beasiswaIndex'])
        ->name('kelolaBeasiswa.index');

    Route::get('/kelola-beasiswa/create', [BeasiswaController::class, 'beasiswaCreate'])
        ->name('kelolaBeasiswa.create');

    Route::post('/kelola-beasiswa/store', [BeasiswaController::class, 'beasiswaStore'])
        ->name('kelolaBeasiswa.store');

    Route::get('/kelola-beasiswa/{id}/edit', [BeasiswaController::class, 'beasiswaEdit'])
        ->name('kelolaBeasiswa.edit');

    Route::post('/kelola-beasiswa/{id}/update', [BeasiswaController::class, 'beasiswaUpdate'])
        ->name('kelolaBeasiswa.update');

    Route::delete('/kelola-beasiswa/{id}/delete', [BeasiswaController::class, 'beasiswaDestroy'])
        ->name('kelolaBeasiswa.destroy');

    Route::get('/kelola-beasiswa/atur-bobot', fn() => view('admin.kelolaBeasiswa.aturBobot'))
        ->name('kelolaBeasiswa.aturBobot');

    Route::get('/kelola-beasiswa/data', fn() => view('admin.kelolaBeasiswa.data'))
        ->name('kelolaBeasiswa.data');

    // ===============================
    // KELOLA PENGGUNA
    // ===============================
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');

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
    Route::get('/bobot-saw', [sawController::class, 'index'])->name('metode.index');
    Route::post('/bobot-saw/store', [sawController::class, 'store'])->name('bobot.store');

    // Tampilkan form edit
    Route::get('/bobot-saw/edit/{id}', [sawController::class, 'edit'])->name('metode.edit');

    // Proses update
    Route::post('/bobot-saw/edit/{id}', [sawController::class, 'update'])->name('metode.update');

    // Route::get('/bobot-saw/edit', [sawController::class, 'update'])->name('metode.edit');
    // Route::post('/bobot-saw/edit', [sawController::class, 'update'])->name('metode.edit');
    Route::post('/bobot-saw/update', [sawController::class, 'update'])->name('bobot.update');

    // Route::get('/metode', fn() => view('admin.metode.index'))
    //     ->name('metode.index');

    // Route::get('/metode/data', fn() => view('admin.metode.data'))
    //     ->name('metode.data');

    // Route::get('/metode/skot-saw', fn() => view('admin.metode.skotSaw'))
    //     ->name('metode.skotSaw');

    // ===============================
    // VALIDASI IPK
    // ===============================
    Route::get('/validasi-ipk', [\App\Http\Controllers\Admin\IpkValidationController::class, 'index'])
        ->name('validasi.ipk.index');
    Route::post('/validasi-ipk/{id}/approve', [\App\Http\Controllers\Admin\IpkValidationController::class, 'approve'])
        ->name('validasi.ipk.approve');
    Route::post('/validasi-ipk/{id}/reject', [\App\Http\Controllers\Admin\IpkValidationController::class, 'reject'])
        ->name('validasi.ipk.reject');

    // ===============================
    // VALIDASI ORGANISASI
    // ===============================
    Route::get('/validasi-organisasi', [\App\Http\Controllers\Admin\OrganisasiValidationController::class, 'index'])
        ->name('validasi.organisasi.index');
    Route::post('/validasi-organisasi/{id}/approve', [\App\Http\Controllers\Admin\OrganisasiValidationController::class, 'approve'])
        ->name('validasi.organisasi.approve');
    Route::post('/validasi-organisasi/{id}/reject', [\App\Http\Controllers\Admin\OrganisasiValidationController::class, 'reject'])
        ->name('validasi.organisasi.reject');

    // ===============================
    // VALIDASI SERTIFIKASI
    // ===============================
    Route::get('/validasi-sertifikasi', [\App\Http\Controllers\Admin\SertifikasiValidationController::class, 'index'])
        ->name('validasi.sertifikasi.index');
    Route::post('/validasi-sertifikasi/{id}/approve', [\App\Http\Controllers\Admin\SertifikasiValidationController::class, 'approve'])
        ->name('validasi.sertifikasi.approve');
    Route::post('/validasi-sertifikasi/{id}/reject', [\App\Http\Controllers\Admin\SertifikasiValidationController::class, 'reject'])
        ->name('validasi.sertifikasi.reject');

    // ===============================
    // LAPORAN
    // ===============================
    Route::get('/laporan', fn() => view('admin.laporan.index'))
        ->name('laporan.index');

    // Report generation & export (PDF)
    Route::get('/laporan/generate', [\App\Http\Controllers\Admin\ReportController::class, 'generate'])
        ->name('laporan.generate');
    Route::get('/laporan/export', [\App\Http\Controllers\Admin\ReportController::class, 'exportPdf'])
        ->name('laporan.export');
    Route::get('/laporan/view', [\App\Http\Controllers\Admin\ReportController::class, 'index'])
        ->name('laporan.view');
});


// ===============================
// ROUTE MAHASISWA DAN UMUM
// ===============================
Route::middleware(['auth', 'verified'])->group(function () {

    // MAHASISWA ROUTES
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\MahasiswaController::class, 'dashboard'])->name('dashboard');
        
        // Beasiswa Routes
        Route::get('/daftar-beasiswa', [\App\Http\Controllers\MahasiswaController::class, 'listBeasiswa'])->name('listBeasiswa');
        Route::get('/beasiswa/{id}', [\App\Http\Controllers\MahasiswaController::class, 'beasiswaDetail'])->name('beasiswa.detail');
        
        // Ajukan Beasiswa Routes
        Route::get('/ajukan-beasiswa', [\App\Http\Controllers\MahasiswaController::class, 'ajukanBeasiswa'])->name('ajukanBeasiswa');
        Route::post('/ajukan-beasiswa', [\App\Http\Controllers\MahasiswaController::class, 'storeAjukanBeasiswa'])->name('ajukanBeasiswa.store');
        
        // Riwayat Pendaftaran Routes
        Route::get('/riwayat-pendaftaran', [\App\Http\Controllers\MahasiswaController::class, 'riwayatPendaftaran'])->name('riwayatPendaftaran');
        
        // Prestasi Routes
        Route::get('/prestasi', [\App\Http\Controllers\MahasiswaController::class, 'prestasi'])->name('prestasi');
        Route::post('/prestasi', [\App\Http\Controllers\MahasiswaController::class, 'storePrestasi'])->name('prestasi.store');
        Route::get('/prestasi/{id}/edit', [\App\Http\Controllers\MahasiswaController::class, 'editPrestasi'])->name('prestasi.edit');
        Route::post('/prestasi/{id}', [\App\Http\Controllers\MahasiswaController::class, 'updatePrestasi'])->name('prestasi.update');
        Route::delete('/prestasi/{id}', [\App\Http\Controllers\MahasiswaController::class, 'deletePrestasi'])->name('prestasi.delete');
        
        // Leaderboard Routes
        Route::get('/leaderboard', [\App\Http\Controllers\MahasiswaController::class, 'leaderboard'])->name('leaderboard');
        
        // Galeri Routes
        Route::get('/galeri', [\App\Http\Controllers\MahasiswaController::class, 'galeri'])->name('galeri');
        
        // Organisasi Routes
        Route::resource('organisasi', \App\Http\Controllers\OrganisasiController::class)->except(['show']);
        
        // Sertifikasi Routes
        Route::resource('sertifikasi', \App\Http\Controllers\SertifikasiController::class)->except(['show']);
    });

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

    Route::post('/profile/ipk', [ProfileController::class, 'updateIpk'])
        ->name('profile.updateIpk');

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
// ROUTE UMUM / PENGUNJUNG (auth + verified)
// ===============================
Route::middleware(['auth', 'verified'])
    ->prefix('umum')
    ->name('umum.')
    ->group(function () {
    
    // Dashboard Umum
    Route::get('/dashboard', [\App\Http\Controllers\UmumController::class, 'dashboard'])
        ->name('dashboard');
    
    // Leaderboard
    Route::get('/leaderboard', [\App\Http\Controllers\UmumController::class, 'leaderboard'])
        ->name('leaderboard');
    
    // Beasiswa Routes
    Route::get('/beasiswa', [\App\Http\Controllers\UmumController::class, 'beasiswa'])
        ->name('beasiswa');
    Route::get('/beasiswa/{id}', [\App\Http\Controllers\UmumController::class, 'beasiswaDetail'])
        ->name('beasiswa.detail');
    
    // Mahasiswa Profile
    Route::get('/mahasiswa/{id}', [\App\Http\Controllers\UmumController::class, 'mahasiswaProfile'])
        ->name('mahasiswa.profile');
});


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
