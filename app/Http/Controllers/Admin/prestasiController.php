<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    // Tampilkan semua prestasi
    public function index()
    {
        $prestasi = Prestasi::with('user')->get();
        return view('admin.verifikasiPrestasi.index', compact('prestasi'));
    }

    // Form tambah prestasi
    public function create()
    {
        $users = User::all();
        return view('admin.verifikasiPrestasi.create', compact('users'));
    }

    // Simpan prestasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis' => 'required|in:akademik,non-akademik',
            'nama_prestasi' => 'required|string',
            'tingkat' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        // if ($request->hasFile('file_sertifikat')) {
        //     $validated['file_sertifikat'] = $request->file('file_sertifikat')->store('public/sertifikat');
        // }

        if ($request->hasFile('file_sertifikat')) {
            // $path = $request->file('file_sertifikat')->store('public/sertifikat');
            $path = $request->file('file_sertifikat')->store('sertifikat', 'public');
            // dd("UPLOAD SAVE TO:", $path);
            $validated['file_sertifikat'] = $path;
        }

        // if ($request->hasFile('file_sertifikat')) {
        //     $path = $request->file('file_sertifikat')->store('public/sertifikat');
        //     // dd($path);
        //     $validated['file_sertifikat'] = $path;
        // }


        // dd($validated);
        Prestasi::create($validated);

        return redirect()->route('admin.verifikasiPrestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    // Form verifikasi / edit prestasi
    public function edit($id)
    {
        $prestasi = Prestasi::with('user')->findOrFail($id);
        return view('admin.verifikasiPrestasi.form', compact('prestasi'));
    }

    // Update status prestasi
    public function updateStatus(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,valid,invalid',
        ]);

        $prestasi->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.verifikasiPrestasi.index')
            ->with('success', 'Status prestasi berhasil diperbarui.');
    }

    // Hapus prestasi
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $prestasi->delete();

        return redirect()->route('admin.verifikasiPrestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    // Tampilkan dokumen (PDF/JPG) di modal
    public function showBukti($id)
    {
    $prestasi = Prestasi::findOrFail($id);

    // Pastikan nama kolom dan folder benar!
    $path = storage_path('app/public/' . $prestasi->file_sertifikat);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file($path);
    }


}
