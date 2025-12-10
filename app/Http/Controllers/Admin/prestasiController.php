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
        
        // Get user's additional data
        $user = $prestasi->user;
        
        // Get user's statistics
        $totalPrestasi = Prestasi::where('user_id', $user->id)->where('status', 'valid')->count();
        $totalPrestasiAkademik = Prestasi::where('user_id', $user->id)
            ->where('jenis', 'akademik')
            ->where('status', 'valid')
            ->count();
        $totalPrestasiNonAkademik = Prestasi::where('user_id', $user->id)
            ->where('jenis', 'non-akademik')
            ->where('status', 'valid')
            ->count();
        
        // Get user's SAW score and ranking
        $skorSaw = \App\Models\SkorSaw::where('user_id', $user->id)->first();
        $leaderboard = \App\Models\Leaderboard::where('user_id', $user->id)->first();
        
        // Get other prestasi from this user
        $prestasiLainnya = Prestasi::where('user_id', $user->id)
            ->where('id', '!=', $id)
            ->where('status', 'valid')
            ->get();
        
        return view('admin.verifikasiPrestasi.form', compact(
            'prestasi',
            'user',
            'totalPrestasi',
            'totalPrestasiAkademik',
            'totalPrestasiNonAkademik',
            'skorSaw',
            'leaderboard',
            'prestasiLainnya'
        ));
    }

    // Update status prestasi
    public function updateStatus(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,valid,invalid',
            'catatan_admin' => 'nullable|string',
        ]);

        $prestasi->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Recalculate SAW if status is valid
        if ($request->status === 'valid') {
            $sawController = new \App\Http\Controllers\Admin\SawController();
            $sawController->hitungNormalisasiSaw();
            $sawController->hitungSkorSaw();
        }

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
