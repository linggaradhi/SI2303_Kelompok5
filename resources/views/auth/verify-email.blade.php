<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-4 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
                <div class="text-center mb-6">
                    <svg class="mx-auto mb-4 h-12 w-12 text-indigo-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm-8 0v1a4 4 0 008 0v-1" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email Anda</h2>
                    <p class="mt-2 text-sm text-gray-600">Terima kasih telah mendaftar! Sebelum memulai, silakan
                        verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan. Jika Anda belum
                        menerima email, klik tombol di bawah untuk mengirim ulang.</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center">
                        Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto group relative flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 ease-in-out hover:scale-[1.02] shadow-md">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto underline text-sm text-gray-600 hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 ease-in-out">
                            Keluar
                        </button>
                    </form>
                </div>
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
