<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-4 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Kata Sandi</h2>
                    <p class="mt-2 text-sm text-gray-600">Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi
                        Anda sebelum melanjutkan.</p>
                </div>
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf
                    <!-- Password -->
                    <div class="relative group">
                        <x-input-label for="password" :value="'Kata Sandi'"
                            class="block text-sm font-medium text-gray-700 mb-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Lock Icon -->
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="16" height="10" x="4" y="11" rx="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0v4" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Kata sandi Anda" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="group relative flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 ease-in-out hover:scale-[1.02] shadow-md">
                            Konfirmasi
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
