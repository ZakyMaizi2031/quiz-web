{{-- resources/views/dashboard/user_dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Berita Terkini
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Halo, {{ Auth::user()->name }}! Selamat datang di situs Berita hangat</h3>

                    <h4 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Berita Pilihan Terbaru</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                        @forelse($beritas as $berita) {{-- Menggunakan loop untuk menampilkan setiap berita --}}
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-lg">
                                @if($berita->foto)
                                    {{-- Gunakan Storage::url() karena menyimpan path relatif di DB --}}
                                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                                @else
                                    {{-- Placeholder jika tidak ada gambar. Pastikan ada gambar default atau sesuaikan div ini --}}
                                    <div class="w-full h-48 bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500 dark:text-gray-400">Gambar Tidak Tersedia</div>
                                @endif
                                <div class="p-4">
                                    <a href="{{ route('beritas.show', $berita->id) }}" class="block">
                                        <h5 class="font-bold text-lg mb-2 leading-tight text-gray-900 dark:text-gray-100 hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ \Illuminate\Support\Str::limit($berita->judul, 50) }}
                                        </h5>
                                    </a>
                                    {{-- Asumsi tanggal_publikasi dicasting sebagai Carbon instance di model Berita --}}
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Oleh {{ $berita->penulis }} pada {{ $berita->tanggal_publikasi->format('d M Y') }}</p>
                                    {{-- strip_tags untuk membersihkan HTML dari snippet --}}
                                    <p class="text-sm text-gray-700 dark:text-gray-200 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 100) }}</p>
                                    <a href="{{ route('beritas.show', $berita->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">Baca Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-600 dark:text-gray-400">Belum ada berita terbaru saat ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
