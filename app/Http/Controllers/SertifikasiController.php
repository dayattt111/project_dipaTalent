<?php

namespace App\Http\Controllers;

use App\Models\Sertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SertifikasiController extends Controller
{
    public function index()
    {
        $sertifikasi = Sertifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.sertifikasi.index', compact('sertifikasi'));
    }

    public function create()
    {
        return view('mahasiswa.sertifikasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sertifikat' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'tanggal_terbit' => 'required|date',
            'tanggal_expired' => 'nullable|date|after:tanggal_terbit',
            'deskripsi' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('bukti_file')) {
            $path = $request->file('bukti_file')->store('sertifikasi', 'public');
            $validated['bukti_file'] = $path;
        }

        // Poin awal berdasarkan jenis sertifikat
        $poinMap = [
            'BNSP' => 3,
            'Bootcamp' => 2,
            'Online Course' => 1,
            'Lainnya' => 1,
        ];
        $validated['poin'] = $poinMap[$validated['jenis']] ?? 1;

        Sertifikasi::create($validated);

        return redirect()->route('mahasiswa.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil ditambahkan dan menunggu validasi admin.');
    }

    public function edit(Sertifikasi $sertifikasi)
    {
        if ($sertifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($sertifikasi->status === 'valid') {
            return redirect()->route('mahasiswa.sertifikasi.index')
                ->with('error', 'Sertifikasi yang sudah divalidasi tidak dapat diedit.');
        }

        return view('mahasiswa.sertifikasi.edit', compact('sertifikasi'));
    }

    public function update(Request $request, Sertifikasi $sertifikasi)
    {
        if ($sertifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($sertifikasi->status === 'valid') {
            return redirect()->route('mahasiswa.sertifikasi.index')
                ->with('error', 'Sertifikasi yang sudah divalidasi tidak dapat diedit.');
        }

        $validated = $request->validate([
            'nama_sertifikat' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'tanggal_terbit' => 'required|date',
            'tanggal_expired' => 'nullable|date|after:tanggal_terbit',
            'deskripsi' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('bukti_file')) {
            if ($sertifikasi->bukti_file) {
                Storage::disk('public')->delete($sertifikasi->bukti_file);
            }
            $path = $request->file('bukti_file')->store('sertifikasi', 'public');
            $validated['bukti_file'] = $path;
        }

        $validated['status'] = 'pending';
        $validated['catatan_admin'] = null;

        $sertifikasi->update($validated);

        return redirect()->route('mahasiswa.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil diperbarui dan menunggu validasi ulang.');
    }

    public function destroy(Sertifikasi $sertifikasi)
    {
        if ($sertifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($sertifikasi->bukti_file) {
            Storage::disk('public')->delete($sertifikasi->bukti_file);
        }

        $sertifikasi->delete();

        return redirect()->route('mahasiswa.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil dihapus.');
    }
}
