{{-- resources/views/dashboard/admin_dashboard.blade.php --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Selamat datang, {{ Auth::user()->name }}!</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        
                        {{-- <a href="{{ route('beritas.index') }}"
                            class="block bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-md transition-all duration-200 text-center">
                            <i class="fas fa-list-alt text-2xl mb-2 text-indigo-600 dark:text-indigo-400"></i>
                            <p class="font-medium text-gray-800 dark:text-gray-200">Kelola Berita</p>
                        </a> --}}

                        {{-- Hanya tampilkan tombol ini jika user adalah admin --}}
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('beritas.create') }}"
                                    class="block bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-md transition-all duration-200 text-center">
                                    <i class="fas fa-plus-circle text-2xl mb-2 text-green-600 dark:text-green-400"></i>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">Tambah Berita</p>
                                </a>
                            @endif
                    </div>

                    {{-- Bagian Berita Terbaru --}}
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Berita Terbaru</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($beritas as $berita)
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow overflow-hidden">
                                @if ($berita->foto)
                                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div
                                        class="w-full h-48 bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                        No Image</div>
                                @endif
                                <div class="p-4">
                                    <h4 class="font-bold text-lg mb-2 truncate">{{ $berita->judul }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Oleh {{ $berita->penulis }}
                                        - {{ $berita->tanggal_publikasi->diffForHumans() }}</p>
                                    <a href="{{ route('beritas.show', $berita->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 text-sm">Baca
                                        Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-gray-600 dark:text-gray-400">Belum ada berita yang diterbitkan.
                            </p>
                        @endforelse
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
