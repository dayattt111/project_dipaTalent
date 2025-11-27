@extends('layouts.admin')

@section('title', 'Generate Laporan')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">
	<h1 class="text-2xl font-semibold mb-4">Generate Laporan Beasiswa</h1>

	<form action="#" method="GET" class="grid grid-cols-1 gap-4">
		<div>
			<label class="block text-sm font-medium text-gray-700">Dari</label>
			<input type="date" name="from" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
		</div>

		<div>
			<label class="block text-sm font-medium text-gray-700">Sampai</label>
			<input type="date" name="to" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
		</div>

		<div>
			<button class="px-4 py-2 bg-blue-600 text-white rounded">Buat Laporan</button>
		</div>
	</form>
</div>

@endsection
