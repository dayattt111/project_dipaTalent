<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Photo Profile Upload -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
            <div class="flex items-center gap-4">
                <!-- Current Photo Preview -->
                <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-gray-200 flex-shrink-0">
                    @if($user->photo_profile)
                        @php
                            $currentPhotoUrl = filter_var($user->photo_profile, FILTER_VALIDATE_URL) 
                                ? $user->photo_profile 
                                : Storage::url($user->photo_profile);
                        @endphp
                        <img id="preview-photo" src="{{ $currentPhotoUrl }}" alt="Profile" class="w-full h-full object-cover"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4F46E5&color=fff&size=128'">
                    @else
                        <div id="preview-photo" class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                
                <!-- Upload Input -->
                <div class="flex-1">
                    <input type="file" name="photo_profile" id="photo_profile" accept="image/*" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                           onchange="previewImage(this)">
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG, atau GIF (max. 2MB)</p>
                    @error('photo_profile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input id="name" name="name" type="text" 
                   value="{{ old('name', $user->name) }}" 
                   required autofocus autocomplete="name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                Email <span class="text-red-500">*</span>
            </label>
            <input id="email" name="email" type="email" 
                   value="{{ old('email', $user->email) }}" 
                   required autocomplete="username"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        Email Anda belum diverifikasi.
                        <button form="send-verification" class="underline text-sm text-yellow-700 hover:text-yellow-900 font-medium">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600 font-medium">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-6">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm text-green-600 font-medium">
                    ✓ Tersimpan
                </p>
            @endif
        </div>
    </form>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview-photo');
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" alt="Preview">`;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
