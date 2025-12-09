<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class SertifikasiValidationController extends Controller
{
    public function index()
    {
        $pendingSertifikasi = Sertifikasi::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20, ['*'], 'pending');
        
        $validatedSertifikasi = Sertifikasi::with('user')
            ->whereIn('status', ['valid', 'invalid'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20, ['*'], 'validated');

        $pendingCount = Sertifikasi::where('status', 'pending')->count();
        $validatedCount = Sertifikasi::whereIn('status', ['valid', 'invalid'])->count();

        return view('admin.validasi.sertifikasi', compact('pendingSertifikasi', 'validatedSertifikasi', 'pendingCount', 'validatedCount'));
    }

    public function approve(Request $request, $id)
    {
        $sertifikasi = Sertifikasi::findOrFail($id);
        
        $sertifikasi->update([
            'status' => 'valid',
            'poin' => $request->poin ?? ($sertifikasi->poin ?: 1),
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Trigger recalculate SAW
        app(\App\Http\Controllers\Admin\SawController::class)->hitungSaw();

        return redirect()->back()->with('success', 'Sertifikasi berhasil divalidasi.');
    }

    public function reject(Request $request, $id)
    {
        $sertifikasi = Sertifikasi::findOrFail($id);
        
        $sertifikasi->update([
            'status' => 'invalid',
            'poin' => 0,
            'catatan_admin' => $request->catatan_admin ?? 'Sertifikat tidak valid',
        ]);

        return redirect()->back()->with('success', 'Sertifikasi ditolak.');
    }
}
