<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-4 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Lupa Kata Sandi?</h2>
                    <p class="mt-2 text-sm text-gray-600">Masukkan alamat email Anda dan kami akan mengirimkan link untuk
                        mengatur ulang kata sandi Anda.</p>
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <!-- Email Address -->
                    <div class="relative group">
                        <x-input-label for="email" :value="'Email'"
                            class="block text-sm font-medium text-gray-700 mb-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Mail Icon -->
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                                    <rect width="18" height="14" x="3" y="6" rx="2" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                type="email" name="email" :value="old('email')" required autofocus
                                placeholder="email@contoh.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="flex justify-center mt-6">
                        <button type="submit"
                            class="group relative flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 ease-in-out hover:scale-[1.02] shadow-md">
                            Kirim Link Reset Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.7s cubic-bezier(0.4, 0, 0.2, 1) both;
        }
    </style>
</x-guest-layout>
