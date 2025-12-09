<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiValidationController extends Controller
{
    public function index()
    {
        $pending = Organisasi::with('user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $validated = Organisasi::with('user')->whereIn('status', ['valid', 'invalid'])->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.validasi.organisasi', compact('pending', 'validated'));
    }

    public function approve(Request $request, $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        
        $organisasi->update([
            'status' => 'valid',
            'poin' => $request->poin ?? 1, // Admin bisa override poin
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Trigger recalculate SAW
        app(\App\Http\Controllers\Admin\SawController::class)->hitungSaw();

        return redirect()->back()->with('success', 'Organisasi berhasil divalidasi.');
    }

    public function reject(Request $request, $id)
    {
        $organisasi = Organisasi::findOrFail($id);
        
        $organisasi->update([
            'status' => 'invalid',
            'poin' => 0,
            'catatan_admin' => $request->catatan_admin ?? 'Data tidak valid',
        ]);

        return redirect()->back()->with('success', 'Organisasi ditolak.');
    }
}
