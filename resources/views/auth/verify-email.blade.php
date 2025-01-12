<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Silakan masukkan kode verifikasi yang telah dikirimkan ke email Anda.') }}
    </div>

    <!-- Error Messages -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if ($errors->any())
        <div class="mb-4">
            <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf

        <!-- Verification Code Input -->
        <div class="mb-4">
            <x-input-label for="code" :value="__('Kode Verifikasi')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus placeholder="Masukkan kode 6 digit" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verifikasi') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Resend Verification Link -->
    <div class="text-sm text-gray-600 mt-4 text-center">
        {{ __('Belum menerima kode?') }}
        <a href="{{ route('verification.input') }}" class="text-blue-500 hover:underline">
            {{ __('Kirim ulang kode') }}
        </a>
    </div>
</x-guest-layout>
