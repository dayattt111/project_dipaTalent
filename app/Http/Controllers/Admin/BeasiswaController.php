<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranBeasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index()
    {
        $pendaftaran = PendaftaranBeasiswa::with(['user', 'beasiswa'])->get();
        return view('admin.dashboard', compact('pendaftaran'));
    }

    public function showVerifikasi($id)
    {
        $pendaftaran = \App\Models\PendaftaranBeasiswa::with(['user', 'beasiswa'])->findOrFail($id);
        return view('admin.verifikasiPendaftar.form', compact('pendaftaran'));
    }

    public function verifikasi($id)
    {
        $pendaftaran = PendaftaranBeasiswa::findOrFail($id);

        // toggle status
        if ($pendaftaran->status === 'diterima') {
            $pendaftaran->status = 'menunggu';
        } else {
            $pendaftaran->status = 'diterima';
        }

        $pendaftaran->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status verifikasi diperbarui!');
    }
}
