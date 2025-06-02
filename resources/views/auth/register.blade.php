<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-4 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Buat Akun Anda</h2>
                    <p class="mt-2 text-sm text-gray-600">Daftar untuk mulai menggunakan layanan</p>
                </div>
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <!-- Name -->
                    <div class="relative group">
                        <x-input-label for="name" :value="'Nama'"
                            class="block text-sm font-medium text-gray-700 mb-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- User Cool Icon -->
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 17.232A6 6 0 006 21h12a6 6 0 00-2.768-3.768z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 12a5 5 0 100-10 5 5 0 000 10z" />
                                </svg>
                            </div>
                            <x-text-input id="name"
                                class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                type="text" name="name" :value="old('name')" placeholder="Nama lengkap Anda" required
                                autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="relative group">
                        <x-input-label for="email" :value="'Email'"
                            class="block text-sm font-medium text-gray-700 mb-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Mail Cool Icon -->
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                                    <rect width="18" height="14" x="3" y="6" rx="2" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                type="email" name="email" :value="old('email')" placeholder="email@contoh.com" required
                                autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="relative group">
                        <x-input-label for="password" :value="'Kata Sandi'"
                            class="block text-sm font-medium text-gray-700 mb-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Lock Cool Icon -->
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="16" height="10" x="4" y="11" rx="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0v4" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                type="password" name="password" placeholder="••••••••" required
                                autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="relative group">
                        <x-input-label for="password_confirmation" :value="'Konfirmasi Kata Sandi'"
                            class="block text-sm font-medium text-gray-700 mb-1" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Shield Check Cool Icon -->
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation"
                                class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required
                                autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <a class="text-sm text-indigo-600 hover:text-indigo-500 focus:underline transition duration-150 ease-in-out"
                            href="{{ route('login') }}">
                            Sudah punya akun?
                        </a>
                        <button type="submit"
                            class="group relative flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 ease-in-out hover:scale-[1.02] shadow-md">
                            Daftar
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
