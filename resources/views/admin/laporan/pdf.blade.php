<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f4f4f4; font-weight: bold; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0 0 10px 0; }
        .header .periode { font-size: 11px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan {{ ucfirst($type ?? 'beasiswa') }}</h2>
        @if(!empty($from) || !empty($to))
            <div class="periode">Periode: {{ $from ?? '—' }} s/d {{ $to ?? '—' }}</div>
        @endif
    </div>

    @if($type === 'beasiswa')
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 25%;">Nama Beasiswa</th>
                    <th style="width: 40%;">Deskripsi</th>
                    <th style="width: 10%;">Kuota</th>
                    <th style="width: 20%;">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->nama_beasiswa ?? $item->judul ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? ''), 100) }}</td>
                        <td>{{ $item->kuota ?? '-' }}</td>
                        <td>{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($type === 'pendaftaran')
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 20%;">Nama Pendaftar</th>
                    <th style="width: 25%;">Beasiswa</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 15%;">IPK</th>
                    <th style="width: 20%;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ optional($item->user)->name ?? '-' }}</td>
                        <td>{{ optional($item->beasiswa)->nama_beasiswa ?? '-' }}</td>
                        <td>{{ ucfirst($item->status ?? 'menunggu') }}</td>
                        <td>{{ $item->ipk ?? '-' }}</td>
                        <td>{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($type === 'prestasi')
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 20%;">Nama Mahasiswa</th>
                    <th style="width: 30%;">Prestasi</th>
                    <th style="width: 15%;">Tingkat</th>
                    <th style="width: 15%;">Tahun</th>
                    <th style="width: 15%;">Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ optional($item->user)->name ?? '-' }}</td>
                        <td>{{ $item->nama_prestasi ?? $item->judul ?? '-' }}</td>
                        <td>{{ ucfirst($item->tingkat ?? '-') }}</td>
                        <td>{{ $item->tahun ?? '-' }}</td>
                        <td>{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #999;">
        <p>Laporan ini dicetak secara otomatis oleh sistem DipaTalent - {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
