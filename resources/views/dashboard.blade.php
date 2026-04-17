<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-b-4 border-indigo-500">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-indigo-100 rounded-full mr-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Sistem Pelaporan Penggunaan Keuangan Pembelian Buku & ATK
                            </p>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-2xl border border-indigo-100 dark:border-gray-600">
                            <h4 class="font-bold text-indigo-900 dark:text-indigo-300 mb-2">Pemberitahuan Penting:</h4>
                            <ul class="text-sm text-indigo-800 dark:text-gray-300 space-y-2">
                                <li>• Pastikan foto nota terlihat jelas (tidak buram).</li>
                                <li>• Pastikan barang yang dibeli sesuai dengan kategori Buku atau ATK.</li>
                                <li>• Hubungi Admin Eratme jika ada kendala sistem.</li>
                            </ul>
                        </div>

                        <div class="flex flex-col justify-center space-y-4">
                            <a href="{{ route('mahasiswa.upload') }}" class="inline-flex justify-center items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition duration-200 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Buat Laporan Baru
                            </a>
                            <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 font-bold rounded-xl transition duration-200">
                                Lihat Riwayat Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>