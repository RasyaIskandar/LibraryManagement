<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 lg:pl-64">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-4 py-3">Judul</th>
                                <th scope="col" class="px-4 py-3">Tanggal Pinjam</th>
                                <th scope="col" class="px-4 py-3">Tanggal Kembali</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pinjamBukus as $item)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->book->judul }}
                                    </th>
                                    <td class="px-4 py-3">{{ $item->tanggal_pinjam }}</td>
                                    <td class="px-4 py-3">{{ $item->tanggal_kembali }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                            {{ $item->status === 'Terlambat' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <!-- Tombol Edit / Perpanjang -->
                                        <form action="{{ route('pinjam.perpanjang', $item->id) }}" method="POST" class="inline-block ms-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="date" name="tanggal_kembali" class="text-sm px-2 py-1 rounded border border-gray-300 dark:border-gray-700" required>
                                            <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-all duration-200">
                                                Perpanjang
                                            </button>
                                        </form>

                                        <!-- Tombol Kembalikan Paksa -->
                                        <form action="{{ route('pinjam.kembalikanPaksa', $item->id) }}" method="POST" class="inline-block ms-2">
                                            @csrf
                                            @method('POST') <!-- Pastikan metode POST digunakan -->
                                            <button type="submit" class="px-4 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 transition-all duration-200">
                                                Kembalikan Paksa
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center">Tidak ada data peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
