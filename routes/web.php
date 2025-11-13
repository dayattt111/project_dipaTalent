<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BeasiswaController;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    // ADMIN ROUTES

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    Route::get('/dashboard', [BeasiswaController::class, 'index'])->name('admin.dashboard');
    // Route::post('/verifikasi-pen-daftar/{id}', [BeasiswaController::class, 'verifikasi'])->name('verifikasiPendaftar.index');
    Route::get('/verifikasi-pendaftaran/{id}', [BeasiswaController::class, 'showVerifikasi'])->name('admin.verifikasiPendaftar.form');
    Route::post('/verifikasi-pendaftaran/{id}', [BeasiswaController::class, 'verifikasi'])->name('admin.verifikasiPendaftar.verifikasi');

    // Kelola Beasiswa
    Route::get('/kelola-beasiswa', function () {
        return view('admin.kelolaBeasiswa.index');
    })->name('admin.kelolaBeasiswa.index');

    Route::get('/kelola-beasiswa/atur-bobot', function () {
        return view('admin.kelolaBeasiswa.aturBobot');
    })->name('admin.kelolaBeasiswa.aturBobot');

    Route::get('/kelola-beasiswa/data', function () {
        return view('admin.kelolaBeasiswa.data');
    })->name('admin.kelolaBeasiswa.data');

    // Verifikasi Pendaftar
    Route::get('/verifikasi-pendaftar', function () {
        return view('admin.verifikasiPendaftar.index');
    })->name('admin.verifikasiPendaftar.index');

    Route::get('/verifikasi-pendaftar/form', function () {
        return view('admin.verifikasiPendaftar.form');
    })->name('admin.verifikasiPendaftar.form');

    // Verifikasi Prestasi
    Route::get('/verifikasi-prestasi', function () {
        return view('admin.verifikasiPrestasi.index');
    })->name('admin.verifikasiPrestasi.index');

    Route::get('/verifikasi-prestasi/form', function () {
        return view('admin.verifikasiPrestasi.form');
    })->name('admin.verifikasiPrestasi.form');

    // Metode SAW
    Route::get('/metode', function () {
        return view('admin.metode.index');
    })->name('admin.metode.index');

    Route::get('/metode/data', function () {
        return view('admin.metode.data');
    })->name('admin.metode.data');

    Route::get('/metode/skot-saw', function () {
        return view('admin.metode.skotSaw');
    })->name('admin.metode.skotSaw');

    // Laporan
    Route::get('/laporan', function () {
        return view('admin.laporan.index');
    })->name('admin.laporan.index');
});


    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/umum/dashboard', function () {
        return view('umum.dashboard');
    })->name('umum.dashboard');
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    } else {
        return redirect()->route('umum.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__.'/auth.php';


// Halaman dashboard (hanya untuk user terverifikasi)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');