<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PendaftaranBeasiswa;
use Illuminate\Http\Request;

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

    public function verifikasi($id)
    {
        // $pendaftaran = PendaftaranBeasiswa::findOrFail($id);
        $pendaftaran = Pendaftaran::findOrFail($id);

        // toggle status
        if ($pendaftaran->status === 'diterima') {
            $pendaftaran->status = 'menunggu';
        } else {
            $pendaftaran->status = 'diterima';
        }

        $pendaftaran->save();

        return redirect()->route('admin.verifikasiPendaftar.index')->with('success', 'Status verifikasi diperbarui!');
    }
}
