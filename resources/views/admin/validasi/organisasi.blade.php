@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Validasi Organisasi Mahasiswa</h1>
                    <p class="mt-2 text-sm text-gray-600">Kelola dan validasi data organisasi yang diajukan mahasiswa</p>
                </div>
                <div class="bg-white px-6 py-3 rounded-lg shadow-sm border border-gray-200">
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Menunggu Validasi</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $pending->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-start">
                <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabs -->
        <div class="bg-white rounded-t-xl shadow-sm border border-gray-200 border-b-0">
            <div class="flex border-b border-gray-200">
                <button onclick="switchTab('pending')" 
                        id="tab-pending" 
                        class="tab-button px-6 py-4 text-sm font-semibold transition-colors duration-200 border-b-2 border-indigo-600 text-indigo-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Menunggu Validasi
                        <span class="ml-2 px-2.5 py-0.5 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full">
                            {{ $pending->count() }}
                        </span>
                    </div>
                </button>
                <button onclick="switchTab('validated')" 
                        id="tab-validated" 
                        class="tab-button px-6 py-4 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors duration-200 border-b-2 border-transparent">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Sudah Divalidasi
                    </div>
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="bg-white rounded-b-xl shadow-sm border border-gray-200">
            <!-- Pending Tab -->
            <div id="content-pending" class="tab-content p-6">
                @if($pending->count() > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach($pending as $org)
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200">
                                <!-- Card Header -->
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 rounded-t-xl">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold text-white">{{ $org->nama_organisasi }}</h3>
                                            <p class="text-sm text-indigo-100 mt-1">{{ $org->jabatan }}</p>
                                        </div>
                                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">
                                            Pending
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-4 space-y-3">
                                    <!-- Mahasiswa Info -->
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $org->user->name }}</p>
                                            <p class="text-xs text-gray-500">NIM: {{ $org->user->nim }}</p>
                                        </div>
                                    </div>

                                    <!-- Organisasi Details -->
                                    <div class="space-y-2">
                                        <div class="flex items-center text-sm">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-gray-600">Periode:</span>
                                            <span class="ml-2 font-medium text-gray-900">{{ $org->periode }}</span>
                                        </div>
                                        
                                        @if($org->deskripsi)
                                            <div class="pt-2 border-t border-gray-200">
                                                <p class="text-xs text-gray-500 mb-1">Deskripsi:</p>
                                                <p class="text-sm text-gray-700">{{ Str::limit($org->deskripsi, 150) }}</p>
                                            </div>
                                        @endif

                                        @if($org->bukti_file)
                                            <div class="pt-2">
                                                <a href="{{ Storage::url($org->bukti_file) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center text-xs text-indigo-600 hover:text-indigo-700 font-medium">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    Lihat Bukti File
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-xs text-gray-500 pt-2 border-t border-gray-200">
                                        Diajukan: {{ \Carbon\Carbon::parse($org->created_at)->format('d M Y, H:i') }}
                                    </div>
                                </div>

                                <!-- Card Footer -->
                                <div class="bg-gray-50 px-4 py-3 rounded-b-xl flex items-center justify-end space-x-2">
                                    <button onclick="openRejectModal({{ $org->id }})"
                                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Tolak
                                    </button>
                                    <button onclick="openApproveModal({{ $org->id }}, '{{ $org->nama_organisasi }}')"
                                            class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Setujui
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Data Pending</h3>
                        <p class="text-gray-600">Semua pengajuan organisasi sudah divalidasi</p>
                    </div>
                @endif
            </div>

            <!-- Validated Tab -->
            <div id="content-validated" class="tab-content hidden p-6">
                @if($validated->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Mahasiswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Organisasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Periode</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Poin</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($validated as $org)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $org->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $org->user->nim }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $org->nama_organisasi }}</div>
                                            @if($org->bukti_file)
                                                <a href="{{ Storage::url($org->bukti_file) }}" 
                                                   target="_blank"
                                                   class="text-xs text-indigo-600 hover:text-indigo-700">
                                                    Lihat Bukti
                                                </a>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $org->jabatan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $org->periode }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($org->status === 'valid')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Valid
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Invalid
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                                                {{ $org->poin }} poin
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($org->updated_at)->format('d M Y') }}
                                        </td>
                                    </tr>
                                    @if($org->catatan_admin)
                                        <tr class="bg-gray-50">
                                            <td colspan="7" class="px-6 py-3">
                                                <div class="flex items-start">
                                                    <svg class="w-4 h-4 text-gray-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs font-medium text-gray-700">Catatan Admin:</p>
                                                        <p class="text-xs text-gray-600 mt-1">{{ $org->catatan_admin }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $validated->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data</h3>
                        <p class="text-gray-600">Belum ada organisasi yang divalidasi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-t-xl">
            <h3 class="text-xl font-bold text-white">Setujui Organisasi</h3>
        </div>
        <form id="approveForm" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <p class="text-gray-700">Anda akan menyetujui organisasi: <span id="orgName" class="font-semibold"></span></p>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Poin <span class="text-gray-400 text-xs">(Opsional, default: 1)</span>
                    </label>
                    <input type="number" 
                           name="poin" 
                           step="0.1"
                           min="0"
                           placeholder="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan poin default (1 poin)</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Catatan <span class="text-gray-400 text-xs">(Opsional)</span>
                    </label>
                    <textarea name="catatan_admin" 
                              rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 rounded-b-xl flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeApproveModal()"
                        class="px-5 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-md hover:shadow-lg">
                    Setujui
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-t-xl">
            <h3 class="text-xl font-bold text-white">Tolak Organisasi</h3>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <p class="text-gray-700">Anda akan menolak pengajuan organisasi ini.</p>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="catatan_admin" 
                              rows="4" 
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 rounded-b-xl flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeRejectModal()"
                        class="px-5 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="px-5 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors shadow-md hover:shadow-lg">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Tab switching
function switchTab(tab) {
    const tabs = ['pending', 'validated'];
    tabs.forEach(t => {
        const tabButton = document.getElementById(`tab-${t}`);
        const tabContent = document.getElementById(`content-${t}`);
        
        if (t === tab) {
            tabButton.classList.add('border-indigo-600', 'text-indigo-600');
            tabButton.classList.remove('border-transparent', 'text-gray-600');
            tabContent.classList.remove('hidden');
        } else {
            tabButton.classList.remove('border-indigo-600', 'text-indigo-600');
            tabButton.classList.add('border-transparent', 'text-gray-600');
            tabContent.classList.add('hidden');
        }
    });
}

// Approve Modal
function openApproveModal(id, name) {
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
    document.getElementById('approveForm').action = `/admin/validasi-organisasi/${id}/approve`;
    document.getElementById('orgName').textContent = name;
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
    document.getElementById('approveModal').classList.remove('flex');
    document.getElementById('approveForm').reset();
}

// Reject Modal
function openRejectModal(id) {
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
    document.getElementById('rejectForm').action = `/admin/validasi-organisasi/${id}/reject`;
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectModal').classList.remove('flex');
    document.getElementById('rejectForm').reset();
}

// Close modal on outside click
document.getElementById('approveModal').addEventListener('click', function(e) {
    if (e.target === this) closeApproveModal();
});

document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endsection
