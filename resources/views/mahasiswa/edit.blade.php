<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight italic">
            {{ __('Perbaiki Laporan: ') }} {{ $report->nama_item }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border-t-4 border-indigo-500">
                
                <form action="{{ route('mahasiswa.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="nama_item" :value="__('Nama Barang / Buku')" />
                                <x-text-input id="nama_item" name="nama_item" type="text" class="mt-1 block w-full" :value="old('nama_item', $report->nama_item)" required />
                            </div>
                            <div>
                                <x-input-label for="harga" :value="__('Harga (Rp)')" />
                                <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga', $report->harga)" required />
                            </div>
                        </div>

                        <hr class="my-2 border-gray-100">

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <x-input-label for="foto_nota" :value="__('Foto Nota (Unggah baru jika ingin mengganti)')" class="font-bold text-indigo-700" />
                            <div class="flex items-center space-x-4 mt-3">
                                <div class="shrink-0">
                                    <p class="text-[9px] text-gray-400 mb-1 uppercase text-center">Lama</p>
                                    <img src="{{ asset('storage/' . $report->foto_nota) }}" class="w-20 h-20 object-cover rounded shadow-sm border-2 border-white">
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="foto_nota" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <x-input-label for="foto_barang" :value="__('Foto Barang / ATK (Unggah baru jika ingin mengganti)')" class="font-bold text-indigo-700" />
                            <div class="flex items-center space-x-4 mt-3">
                                <div class="shrink-0">
                                    <p class="text-[9px] text-gray-400 mb-1 uppercase text-center">Lama</p>
                                    <img src="{{ asset('storage/' . $report->foto_barang) }}" class="w-20 h-20 object-cover rounded shadow-sm border-2 border-white">
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="foto_barang" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-6 space-x-3">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-md text-xs font-bold hover:bg-gray-200 transition">
                            BATAL
                        </a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-md">
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>