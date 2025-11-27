<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f4f4f4; }
        .header { text-align: center; margin-bottom: 12px; }
    </style>
 </head>
<body>
    <div class="header">
        <h2>Laporan: {{ ucfirst($type ?? 'beasiswa') }}</h2>
        @if(!empty($from) || !empty($to))
            <div>Periode: {{ $from ?? '—' }} s/d {{ $to ?? '—' }}</div>
        @endif
    </div>

    @if($type === 'beasiswa')
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->judul ?? $item->nama ?? '' }}</td>
                        <td>{{ \\Illuminate\\Support\\Str::limit(strip_tags($item->deskripsi ?? $item->keterangan ?? ''), 200) }}</td>
                        <td>{{ optional($item->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($type === 'pendaftaran')
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Beasiswa</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ optional($item->user)->name ?? ($item->nama ?? '-') }}</td>
                        <td>{{ optional($item->beasiswa)->judul ?? '-' }}</td>
                        <td>{{ $item->status ?? '-' }}</td>
                        <td>{{ optional($item->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($type === 'prestasi')
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Judul Prestasi</th>
                    <th>Tingkat</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data ?? [] as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ optional($item->user)->name ?? ($item->nama ?? '-') }}</td>
                        <td>{{ $item->judul ?? '-' }}</td>
                        <td>{{ $item->tingkat ?? '-' }}</td>
                        <td>{{ optional($item->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
