@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Validasi Sertifikasi Mahasiswa</h1>
                    <p class="text-gray-600 mt-2">Kelola dan validasi data sertifikasi mahasiswa</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg">
                        <span class="font-semibold">{{ $pendingCount }}</span> Menunggu Validasi
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Tabs -->
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button onclick="showTab('pending')" id="tab-pending" class="tab-button active border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600">
                    Menunggu Validasi
                    <span class="ml-2 px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded-full text-xs">{{ $pendingCount }}</span>
                </button>
                <button onclick="showTab('validated')" id="tab-validated" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Sudah Divalidasi
                    <span class="ml-2 px-2 py-0.5 bg-gray-100 text-gray-800 rounded-full text-xs">{{ $validatedCount }}</span>
                </button>
            </nav>
        </div>

        <!-- Pending Tab -->
        <div id="content-pending" class="tab-content">
            @if($pendingSertifikasi->count() > 0)
            <div class="space-y-4">
                @foreach($pendingSertifikasi as $sertifikasi)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($sertifikasi->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $sertifikasi->user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $sertifikasi->user->nim }} • {{ $sertifikasi->user->email }}</p>
                                </div>
                            </div>

                            <div class="pl-15 space-y-3">
                                <div>
                                    <h5 class="text-base font-semibold text-gray-900">{{ $sertifikasi->nama_sertifikat }}</h5>
                                    <p class="text-sm text-gray-600 mt-1">{{ $sertifikasi->penerbit }}</p>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Jenis</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $sertifikasi->jenis }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Poin Saat Ini</p>
                                        <p class="text-sm font-bold text-purple-600">{{ $sertifikasi->poin }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Terbit</p>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($sertifikasi->tanggal_terbit)->format('d M Y') }}</p>
                                    </div>
                                    @if($sertifikasi->tanggal_expired)
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Expired</p>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($sertifikasi->tanggal_expired)->format('d M Y') }}</p>
                                    </div>
                                    @endif
                                </div>

                                @if($sertifikasi->nomor_sertifikat)
                                <div>
                                    <p class="text-xs text-gray-500">Nomor Sertifikat</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $sertifikasi->nomor_sertifikat }}</p>
                                </div>
                                @endif

                                @if($sertifikasi->bukti_file)
                                <div>
                                    <a href="{{ Storage::url($sertifikasi->bukti_file) }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-medium rounded-lg transition">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                                        </svg>
                                        Lihat Bukti Sertifikat
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 ml-6">
                            <button onclick="openApproveModal({{ $sertifikasi->id }}, '{{ $sertifikasi->nama_sertifikat }}', '{{ $sertifikasi->user->name }}', {{ $sertifikasi->poin }})" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Setujui
                            </button>
                            <button onclick="openRejectModal({{ $sertifikasi->id }}, '{{ $sertifikasi->nama_sertifikat }}', '{{ $sertifikasi->user->name }}')" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $pendingSertifikasi->links() }}
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada data menunggu validasi</h3>
                <p class="mt-2 text-sm text-gray-500">Semua sertifikasi telah divalidasi</p>
            </div>
            @endif
        </div>

        <!-- Validated Tab -->
        <div id="content-validated" class="tab-content hidden">
            @if($validatedSertifikasi->count() > 0)
            <div class="space-y-4">
                @foreach($validatedSertifikasi as $sertifikasi)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($sertifikasi->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $sertifikasi->user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $sertifikasi->user->nim }} • {{ $sertifikasi->user->email }}</p>
                                </div>
                                @if($sertifikasi->status === 'valid')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Valid
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        Ditolak
                                    </span>
                                @endif
                            </div>

                            <div class="pl-15 space-y-3">
                                <div>
                                    <h5 class="text-base font-semibold text-gray-900">{{ $sertifikasi->nama_sertifikat }}</h5>
                                    <p class="text-sm text-gray-600 mt-1">{{ $sertifikasi->penerbit }} • {{ $sertifikasi->jenis }}</p>
                                </div>

                                <div class="flex items-center gap-6">
                                    <div>
                                        <p class="text-xs text-gray-500">Poin</p>
                                        <p class="text-sm font-bold text-purple-600">{{ $sertifikasi->poin }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Terbit</p>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($sertifikasi->tanggal_terbit)->format('d M Y') }}</p>
                                    </div>
                                </div>

                                @if($sertifikasi->catatan_admin)
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-xs font-semibold text-gray-700 mb-1">Catatan Admin:</p>
                                    <p class="text-sm text-gray-600">{{ $sertifikasi->catatan_admin }}</p>
                                </div>
                                @endif

                                @if($sertifikasi->bukti_file)
                                <div>
                                    <a href="{{ Storage::url($sertifikasi->bukti_file) }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                                        </svg>
                                        Lihat Bukti
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $validatedSertifikasi->links() }}
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada data tervalidasi</h3>
                <p class="mt-2 text-sm text-gray-500">Data yang telah divalidasi akan muncul di sini</p>
            </div>
            @endif
        </div>

    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mt-4 text-center">Setujui Sertifikasi</h3>
            <p class="text-sm text-gray-500 mt-2 text-center">Anda akan menyetujui sertifikasi:</p>
            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm font-medium text-gray-900" id="approve-name"></p>
                <p class="text-xs text-gray-500 mt-1" id="approve-mahasiswa"></p>
            </div>
            
            <form id="approveForm" method="POST">
                @csrf
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Poin</label>
                    <input type="number" name="poin" id="approve-poin" min="0" step="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Default sesuai jenis">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan poin default</p>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan_admin" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeApproveModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition">
                        Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mt-4 text-center">Tolak Sertifikasi</h3>
            <p class="text-sm text-gray-500 mt-2 text-center">Anda akan menolak sertifikasi:</p>
            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm font-medium text-gray-900" id="reject-name"></p>
                <p class="text-xs text-gray-500 mt-1" id="reject-mahasiswa"></p>
            </div>
            
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea name="catatan_admin" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm" placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Tab switching
function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.add('active', 'border-blue-500', 'text-blue-600');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
}

// Approve Modal
function openApproveModal(id, name, mahasiswa, defaultPoin) {
    document.getElementById('approve-name').textContent = name;
    document.getElementById('approve-mahasiswa').textContent = 'Mahasiswa: ' + mahasiswa;
    document.getElementById('approve-poin').value = defaultPoin;
    document.getElementById('approveForm').action = `/admin/validasi-sertifikasi/${id}/approve`;
    document.getElementById('approveModal').classList.remove('hidden');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
    document.getElementById('approveForm').reset();
}

// Reject Modal
function openRejectModal(id, name, mahasiswa) {
    document.getElementById('reject-name').textContent = name;
    document.getElementById('reject-mahasiswa').textContent = 'Mahasiswa: ' + mahasiswa;
    document.getElementById('rejectForm').action = `/admin/validasi-sertifikasi/${id}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectForm').reset();
}

// Close modal when clicking outside
window.onclick = function(event) {
    const approveModal = document.getElementById('approveModal');
    const rejectModal = document.getElementById('rejectModal');
    if (event.target == approveModal) {
        closeApproveModal();
    }
    if (event.target == rejectModal) {
        closeRejectModal();
    }
}
</script>
@endsection
