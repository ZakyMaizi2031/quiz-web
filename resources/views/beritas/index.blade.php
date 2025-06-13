{{-- resources/views/beritas/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Daftar Berita
            </h2>
            <a href="{{ route('beritas.create') }}"
                class="bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition duration-200 ease-in-out">
                Tambah Berita Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 dark:bg-green-800 dark:border-green-600 dark:text-green-200 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Menghilangkan 'd fe' yang sepertinya typo --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Foto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Publikasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            {{-- Penambahan kelas 'odd:bg-white dark:odd:bg-gray-800' dan 'even:bg-gray-50 dark:even:bg-gray-700' untuk zebra stripping --}}
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($beritas as $berita)
                                <tr class="odd:bg-white dark:odd:bg-gray-800 even:bg-gray-50 dark:even:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $loop->iteration }} {{-- Ini akan menampilkan nomor urut (1, 2, 3, ...) --}}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($berita->foto)
                                            <img src="{{ asset('storage/' . $berita->foto) }}"
                                                alt="{{ $berita->judul }}"
                                                class="w-20 h-20 object-cover rounded-md shadow-sm"> {{-- Menyesuaikan ukuran gambar --}}
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500 text-sm">(tidak ada foto)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ \Illuminate\Support\Str::limit($berita->judul, 70) }}</td> {{-- Membatasi panjang judul --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $berita->penulis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $berita->tanggal_publikasi->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('beritas.show', $berita->id) }}"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 transition duration-150 ease-in-out" title="Lihat Detail">
                                                Lihat
                                            </a>
                                            <a href="{{ route('beritas.edit', $berita->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 transition duration-150 ease-in-out" title="Edit Berita">
                                                Edit
                                            </a>
                                            <form action="{{ route('beritas.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 transition duration-150 ease-in-out" title="Hapus Berita">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada berita yang tersedia.
                                        @if(Auth::check() && Auth::user()->role == 'admin')
                                            <a href="{{ route('beritas.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline ml-1">Tambah Berita Baru</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tambahkan paginasi jika Anda mengirimkan paginated data dari controller --}}
                    @if (isset($beritas) && method_exists($beritas, 'links'))
                        <div class="mt-4 px-6">
                            {{ $beritas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
