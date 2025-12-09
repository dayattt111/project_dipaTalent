<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IpkValidationController extends Controller
{
    public function index()
    {
        $pending = User::where('role', 'mahasiswa')
            ->where('ipk_status', 'pending')
            ->whereNotNull('ipk')
            ->orderBy('updated_at', 'desc')
            ->get();

        $validated = User::where('role', 'mahasiswa')
            ->whereIn('ipk_status', ['valid', 'invalid'])
            ->whereNotNull('ipk')
            ->orderBy('ipk_verified_at', 'desc')
            ->paginate(20);

        return view('admin.validasi.ipk', compact('pending', 'validated'));
    }

    public function approve(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'ipk_status' => 'valid',
            'ipk_verified_at' => now(),
            'ipk_catatan_admin' => $request->catatan_admin,
        ]);

        // Trigger recalculate SAW karena IPK berubah
        app(\App\Http\Controllers\Admin\SawController::class)->hitungSaw();

        return redirect()->back()->with('success', 'IPK mahasiswa berhasil divalidasi.');
    }

    public function reject(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'ipk_status' => 'invalid',
            'ipk_verified_at' => now(),
            'ipk_catatan_admin' => $request->catatan_admin ?? 'IPK tidak sesuai dengan data akademik',
        ]);

        return redirect()->back()->with('success', 'IPK ditolak.');
    }
}
