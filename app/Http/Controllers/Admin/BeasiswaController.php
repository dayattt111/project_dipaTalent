<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Beasiswa;
use App\Models\User;
use App\Models\PendaftaranBeasiswa;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BeasiswaController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['user', 'beasiswa'])->get();
        return view('admin.verifikasiPendaftar.index', compact('pendaftaran'));
    }

    public function showVerifikasi($id)
    {
        // ambil data pendaftaran sesuai ID
        $pendaftaran = Pendaftaran::with(['user', 'beasiswa'])->findOrFail($id);
        // $pendaftaran = Pendaftaran::with(['user', 'beasiswa'])->find($id);

        if (!$pendaftaran) {
            abort(404, 'Data pendaftar tidak ditemukan');
        }

        return view('admin.verifikasiPendaftar.forms', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
    $pendaftaran = Pendaftaran::findOrFail($id);

    // Validasi status wajib
    $request->validate([
        'status' => 'required|in:diterima,ditolak,menunggu'
    ]);

    $pendaftaran->update([
        'ipk' => $request->ipk,
        'prestasi' => $request->prestasi,
        'organisasi' => $request->organisasi,
        'keterampilan' => $request->keterampilan,
        'catatan_admin' => $request->catatan_admin,
        'status' => $request->status,  // WAJIB ADA
    ]);

    return redirect()
        ->route('admin.verifikasiPendaftar.index')
        ->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    // public function verifikasi($id){
    //     // $pendaftaran = PendaftaranBeasiswa::findOrFail($id);
    //     $pendaftaran = Pendaftaran::findOrFail($id);

    //     // toggle status
    //     if ($pendaftaran->status === 'diterima') {
    //         $pendaftaran->status = 'menunggu';
    //     } else {
    //         $pendaftaran->status = 'diterima';
    //     }

    //     $pendaftaran->save();

    //     return redirect()->route('admin.verifikasiPendaftar.index')->with('success', 'Status verifikasi diperbarui!');
    // }
        public function verifikasi(Request $request, $id)
        {
            $pendaftaran = Pendaftaran::findOrFail($id);

            if ($request->status == 'setujui') {
                $pendaftaran->update([
                    'status' => 'diterima',
                    'catatan_admin' => $request->catatan_admin,
                ]);
            }

            if ($request->status == 'tolak') {
                $pendaftaran->update([
                    'status' => 'ditolak',
                    'catatan_admin' => $request->catatan_admin,
                ]);
            }

            return redirect()->route('admin.verifikasiPendaftar.index')->with('success', 'Verifikasi berhasil.');
        }

    public function batal($id)
    {
    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->update([
        'status' => 'menunggu',
    ]);

    return redirect()->route('admin.verifikasiPendaftar.index')
        ->with('success', 'Status berhasil dikembalikan ke menunggu.');
    }

    public function create()
    {
        $users = User::all(); // Dropdown user
        $beasiswa = Beasiswa::all();

        return view('admin.verifikasiPendaftar.create', compact('users', 'beasiswa'));
    }

    public function getUserData($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        return response()->json([
            'nim' => $user->nim
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'beasiswa_id' => 'required',
            'nim' => 'required',
            'ipk' => 'required',
            'prestasi' => 'nullable',
            'organisasi' => 'nullable',
            'keterampilan' => 'nullable',
            'transkrip' => 'required|file',
            'foto' => 'required|file',
        ]);

        // Upload file
        $validated['transkrip'] = $request->file('transkrip')->store('transkrip');
        $validated['foto'] = $request->file('foto')->store('foto');

        Pendaftaran::create($validated);

        return redirect()->route('admin.verifikasiPendaftar.index')
            ->with('success', 'Pendaftar berhasil ditambahkan.');
    }
    public function destroy($id)
    {
        $pendaftar = Pendaftaran::findOrFail($id);
        $pendaftar->delete();

        return redirect()->route('admin.verifikasiPendaftar.index')->with('success', 'Pendaftar berhasil dihapus.');
    }


}
