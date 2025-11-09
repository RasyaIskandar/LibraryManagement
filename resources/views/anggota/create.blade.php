<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 p-5 sm:p-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12 lg:pl-64">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="mb-6">
                    <div class="flex items-center p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 13V7a2 2 0 00-2-2H4a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2zM9 9a1 1 0 112 0v2a1 1 0 11-2 0V9z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                        <div>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Rest of the page -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                <div class="m-5 text-center sm:flex-row item-center space-y-4 sm:space-y-0">
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">RIWAYAT PINJAM BUKU</h1>
                </div>
                
                <div class="overflow-x-auto mt-6">
                    <table class="min-w-full text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left">JUDUL BUKU</th>
                                <th scope="col" class="px-6 py-4 text-left">PENULIS</th>
                                <th scope="col" class="px-6 py-4 text-left">TANGGAL PINJAM</th>
                                <th scope="col" class="px-6 py-4 text-left">TANGGAL KEMBALI</th>
                                <th scope="col" class="px-6 py-4 text-left">SISA WAKTU</th>
                                <th scope="col" class="px-6 py-4 text-left">STATUS</th>
                                <th scope="col" class="px-6 py-4 text-left">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                                <!-- Table Rows -->
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                                    <td class="px-6 py-4">{{ $loan->book->judul }}</td>
                                    <td class="px-6 py-4">{{ $loan->book->penulis }}</td>
                                    <td class="px-6 py-4">{{ $loan->tanggal_pinjam }}</td>
                                    <td class="px-6 py-4">{{ $loan->tanggal_kembali }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $sisaHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($loan->tanggal_kembali), false);
                                        @endphp
                                        <span class="inline-block px-3 py-1 text-sm font-medium">
                                            @if ($loan->status === 'returned')
                                                Sudah Dikembalikan
                                            @else
                                                {{ $sisaHari > 0 ? $sisaHari . ' hari' : 'Lewat ' . abs($sisaHari) . ' hari' }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium {{ $loan->status === 'borrowed' ? 'text-green-500' : 'text-red-500' }}">
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($loan->status === 'borrowed')
                                            <button data-modal-target="modal-{{ $loan->id }}" data-modal-toggle="modal-{{ $loan->id }}"
                                                class="inline-flex items-center justify-center px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg hover:bg-indigo-600 focus:ring-4 focus:ring-blue-300 transition duration-300 transform hover:scale-105 shadow-md">
                                                KEMBALIKAN
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div id="modal-{{ $loan->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-md w-full">
                                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Konfirmasi Pengembalian</h2>
                                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                                            Apakah Anda yakin ingin mengembalikan buku <span class="font-semibold">{{ $loan->book->judul }}</span>?
                                        </p>
                                        <div class="flex justify-end space-x-4">
                                            <button data-modal-toggle="modal-{{ $loan->id }}" 
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-2 focus:ring-gray-400 transition">
                                                Batal
                                            </button>
                                            <form action="{{ route('anggota.kembalikan', $loan->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-700 rounded-lg hover:from-red-600 hover:to-red-800 focus:ring-4 focus:ring-red-300 transition">
                                                    Ya, Kembalikan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll("[data-modal-toggle]").forEach(button => {
            button.addEventListener("click", () => {
                const target = button.getAttribute("data-modal-target");
                const modal = document.getElementById(target);
                modal.classList.toggle("hidden");
            });
        });
    </script>
</x-app-layout>
