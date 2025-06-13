{{-- resources/views/beritas/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Berita
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">

                    {{-- Foto Berita --}}
                    @if($berita->foto)
                        <div class="mb-6 text-center">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                 class="max-w-full lg:max-w-xl mx-auto h-auto rounded-lg shadow-lg object-cover">
                        </div>
                    @endif

                    {{-- Judul Berita --}}
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                        {{ $berita->judul }}
                    </h1>

                    {{-- Informasi Penulis dan Tanggal --}}
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Oleh <span class="font-semibold">{{ $berita->penulis }}</span> pada
                        <span class="font-semibold">{{ $berita->tanggal_publikasi->format('d F Y, H:i') }} WIB</span>
                    </p>

                    {{-- Isi Berita --}}
                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-justify">
                        {{-- Menggunakan nl2br untuk menampilkan baris baru dari textarea --}}
                        {!! nl2br(e($berita->isi_berita)) !!}
                    </div>

                    <div class="mt-8 flex justify-end">
                        {{-- Langsung arahkan ke rute 'dashboard' --}}
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Kembali ke Dashboard') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
