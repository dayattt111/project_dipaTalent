<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.organisasi.index', compact('organisasi'));
    }

    public function create()
    {
        return view('mahasiswa.organisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('bukti_file')) {
            $path = $request->file('bukti_file')->store('organisasi', 'public');
            $validated['bukti_file'] = $path;
        }

        $validated['poin'] = 1;

        Organisasi::create($validated);

        return redirect()->route('mahasiswa.organisasi.index')
            ->with('success', 'Data organisasi berhasil ditambahkan dan menunggu validasi admin.');
    }

    public function edit(Organisasi $organisasi)
    {
        if ($organisasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($organisasi->status === 'valid') {
            return redirect()->route('mahasiswa.organisasi.index')
                ->with('error', 'Data yang sudah divalidasi tidak dapat diedit.');
        }

        return view('mahasiswa.organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        if ($organisasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($organisasi->status === 'valid') {
            return redirect()->route('mahasiswa.organisasi.index')
                ->with('error', 'Data yang sudah divalidasi tidak dapat diedit.');
        }

        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('bukti_file')) {
            if ($organisasi->bukti_file) {
                Storage::disk('public')->delete($organisasi->bukti_file);
            }
            $path = $request->file('bukti_file')->store('organisasi', 'public');
            $validated['bukti_file'] = $path;
        }

        $validated['status'] = 'pending';
        $validated['catatan_admin'] = null;

        $organisasi->update($validated);

        return redirect()->route('mahasiswa.organisasi.index')
            ->with('success', 'Data organisasi berhasil diperbarui dan menunggu validasi ulang.');
    }

    public function destroy(Organisasi $organisasi)
    {
        if ($organisasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($organisasi->bukti_file) {
            Storage::disk('public')->delete($organisasi->bukti_file);
        }

        $organisasi->delete();

        return redirect()->route('mahasiswa.organisasi.index')
            ->with('success', 'Data organisasi berhasil dihapus.');
    }
}
