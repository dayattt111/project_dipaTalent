@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Laporan</h1>
    </div>

    <div class="bg-white shadow rounded p-6 mb-6">
        <form method="GET" action="#" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Laporan</label>
                <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="beasiswa">Beasiswa</option>
                    <option value="prestasi">Prestasi</option>
                    <option value="pendaftaran">Pendaftaran</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Dari</label>
                <input type="date" name="from" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Sampai</label>
                <input type="date" name="to" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div class="md:col-span-3 flex gap-2 mt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Tampilkan</button>
                <button type="button" class="px-4 py-2 bg-gray-200 rounded text-gray-700">Export PDF</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h3 class="text-lg font-semibold mb-4">Riwayat Laporan</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama Laporan</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Tanggal Dibuat</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Jenis</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Laporan Beasiswa 2023</td>
                        <td class="px-6 py-4 text-sm text-gray-700">15 Mei 2024</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Beasiswa</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Selesai</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Laporan Prestasi 2024</td>
                        <td class="px-6 py-4 text-sm text-gray-700">20 Juni 2024</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Prestasi</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Selesai</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
