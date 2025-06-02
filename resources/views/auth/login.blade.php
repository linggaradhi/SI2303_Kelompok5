<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-4 transform hover:scale-[1.01] transition-all duration-300">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <!-- Logo/Brand Section -->
                <div class="text-center">
                    <h2 class="mt-2 text-3xl font-bold text-gray-900 tracking-tight">
                        Selamat datang kembali
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Masuk untuk melanjutkan aktivitas Anda
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-4">
                        <div class="relative group">
                            <x-input-label for="email" :value="'Email'"
                                class="block text-sm font-medium text-gray-700 mb-1" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <x-text-input id="email"
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                    type="email" name="email" :value="old('email')" placeholder="email@contoh.com"
                                    required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="relative group">
                            <x-input-label for="password" :value="'Kata Sandi'"
                                class="block text-sm font-medium text-gray-700 mb-1" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd" />
                                </div>
                                <x-text-input id="password"
                                    class="pl-10 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all duration-150 ease-in-out"
                                    type="password" name="password" placeholder="••••••••" required
                                    autocomplete="current-password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer transition duration-150 ease-in-out">
                            <label for="remember_me"
                                class="ml-2 block text-sm text-gray-900 select-none cursor-pointer">
                                Ingat saya
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}"
                                    class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition duration-150 ease-in-out">
                                    Lupa kata sandi?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 ease-in-out hover:scale-[1.02]">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition-colors duration-150 ease-in-out"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            Masuk
                        </button>
                    </div>

                    <!-- Registration Link -->
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition-all duration-150 ease-in-out">
                                Daftar di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
