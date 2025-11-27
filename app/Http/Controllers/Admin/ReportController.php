<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Pendaftaran;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Show report filter form / index
    public function index(Request $request)
    {
        return view('admin.laporan.index');
    }

    // Generate preview (shows filtered data)
    public function generate(Request $request)
    {
        $type = $request->get('type', 'beasiswa');
        $from = $request->get('from');
        $to = $request->get('to');

        $data = [];

        if ($type === 'beasiswa') {
            $query = Beasiswa::query();
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->get();
        }

        if ($type === 'pendaftaran') {
            $query = Pendaftaran::with(['user', 'beasiswa']);
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->get();
        }

        if ($type === 'prestasi') {
            $query = Prestasi::with('user');
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->get();
        }

        return view('admin.laporan.index', compact('type', 'from', 'to', 'data'));
    }

    // Export PDF
    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'beasiswa');
        $from = $request->get('from');
        $to = $request->get('to');

        // reuse generate logic to fetch data
        $data = [];
        if ($type === 'beasiswa') {
            $query = Beasiswa::query();
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->get();
        }
        if ($type === 'pendaftaran') {
            $query = Pendaftaran::with(['user', 'beasiswa']);
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->get();
        }
        if ($type === 'prestasi') {
            $query = Prestasi::with('user');
            if ($from) $query->whereDate('created_at', '>=', $from);
            if ($to) $query->whereDate('created_at', '<=', $to);
            $data = $query->get();
        }

        $view = view('admin.laporan.pdf', compact('type', 'from', 'to', 'data'));

        // Note: requires barryvdh/laravel-dompdf to be installed
        try {
            $pdf = Pdf::loadView('admin.laporan.pdf', compact('type', 'from', 'to', 'data'))->setPaper('a4', 'portrait');
            $filename = 'laporan_' . $type . '_' . now()->format('Ymd_His') . '.pdf';
            return $pdf->download($filename);
        } catch (\Throwable $e) {
            // If DomPDF is not installed, show view as fallback
            return $view->with('warning', 'Dompdf belum terpasang. Jalankan composer require barryvdh/laravel-dompdf');
        }
    }
}
