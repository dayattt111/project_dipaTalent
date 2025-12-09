<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class SertifikasiValidationController extends Controller
{
    public function index()
    {
        $pending = Sertifikasi::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $validated = Sertifikasi::with('user')->whereIn('status', ['valid', 'invalid'])->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.validasi.sertifikasi', compact('pending', 'validated'));
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
