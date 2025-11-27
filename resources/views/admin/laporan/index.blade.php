@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="max-w-7xl">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Laporan</h1>
        <p class="text-gray-600 mt-1">Kelola dan export laporan sistem</p>
    </div>

    {{-- Filter Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Filter Laporan</h2>
        <form method="GET" action="{{ route('admin.laporan.generate') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Type Select --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="beasiswa">Beasiswa</option>
                        <option value="pendaftaran">Pendaftaran</option>
                        <option value="prestasi">Prestasi</option>
                    </select>
                </div>

                {{-- From Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="from" value="{{ request('from') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- To Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="to" value="{{ request('to') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.896-1.011.5.5 0 0 0-.448.894c.311.342.592.753.82 1.220.228.488.235 1.231-.296 1.842A2.478 2.478 0 0 1 8 13.71a.5.5 0 0 0 0 1c.18 0 .356-.016.534-.05 1.087-.188 1.949-.667 2.351-1.447.468-.987.472-2.054.156-2.849-.28-.588-.664-1.179-1.125-1.656a1 1 0 0 0-1.559.857z"/>
                    </svg>
                    Cari
                </button>
                <a href="{{ route('admin.laporan.export') }}?type={{ request('type', 'beasiswa') }}&from={{ request('from') }}&to={{ request('to') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                    </svg>
                    Export PDF
                </a>
            </div>
        </form>
    </div>

    {{-- Data Preview --}}
    @if(!empty($data) && count($data) > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">
                Laporan {{ ucfirst(request('type', 'beasiswa')) }}
                @if(!empty(request('from')) || !empty(request('to')))
                    <span class="text-sm font-normal text-gray-600">({{ request('from') ?? '-' }} s/d {{ request('to') ?? '-' }})</span>
                @endif
            </h3>
        </div>

        <div class="overflow-x-auto">
            @if(request('type') === 'beasiswa')
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Judul</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($data as $i => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->judul ?? $item->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? $item->keterangan ?? ''), 100) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif(request('type') === 'pendaftaran')
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Pendaftar</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Beasiswa</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($data as $i => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ optional($item->user)->name ?? ($item->nama ?? '-') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ optional($item->beasiswa)->judul ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $item->status ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif(request('type') === 'prestasi')
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Prestasi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tingkat</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($data as $i => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ optional($item->user)->name ?? ($item->nama ?? '-') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->judul ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->tingkat ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16" class="mx-auto text-gray-400 mb-3">
            <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
        </svg>
        <p class="text-gray-600">Silakan gunakan filter di atas untuk mencari laporan</p>
    </div>
    @endif
</div>

@endsection
