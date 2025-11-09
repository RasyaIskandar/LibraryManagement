<x-app-layout>
    <section class="p-6 sm:p-8 lg:pl-64 bg-gradient-to-r from-blue-50 to-blue-100">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Alert -->
            @if (session('success'))
                <div id="alert-success" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Title -->
            <h1 class="text-4xl font-semibold mb-6 text-gray-800 text-center">
                <span class="bg-gradient-to-r from-purple-600 to-blue-500 text-transparent bg-clip-text">Lemari Buku</span>
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($books as $book)
                    <div class="relative bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 ease-in-out">
                        <div class="flex items-center p-6 space-x-6">
                            <div class="flex flex-col space-y-4">
                                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $book->judul }}</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Penulis: <span class="font-medium">{{ $book->penulis }}</span></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Stock: <span class="font-medium">{{ $book->jumlah_stok }}</span></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Kategori: <span class="font-medium">{{ $book->kategori }}</span></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Status:
                                    <span class="font-medium px-2 py-1 rounded-full {{ $book->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ $book->status ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </p>
                                <div class="mt-4">
                                    @if ($book->status == 1)
                                        <button id="defaultModalButton" data-modal-target="modal-{{ $book->id }}" data-modal-toggle="modal-{{ $book->id }}"
                                                class="block bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg text-sm px-6 py-3 text-center shadow-lg transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
                                            Pinjam
                                        </button>
                                    @else
                                        <button disabled class="block bg-gray-400 text-white font-medium rounded-lg text-sm px-6 py-3 text-center shadow-lg opacity-70">
                                            Tidak tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="modal-{{ $book->id }}" class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-60 bg-black z-50">
                        <div class="relative p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full">
                            <div class="flex justify-between items-center pb-4 mb-4 border-b dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Peminjaman Buku</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-900 dark:text-gray-200" data-modal-toggle="modal-{{ $book->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('anggota.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <div class="grid gap-6 mb-6">
                                    <div>
                                        <label for="tanggal_kembali" class="text-sm font-medium text-gray-900 dark:text-white">Tanggal Kembali</label>
                                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="w-full p-3 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-white">
                                    </div>
                                </div>
                                <button type="submit" class="bg-gradient-to-r from-green-500 to-blue-500 text-white font-medium rounded-lg px-6 py-3 w-full transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                    Pinjam
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Script for Flash Message Auto-Dismiss -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('#alert-success, #alert-error').forEach(alert => {
                    alert.remove();
                });
            }, 3000); // 3 seconds
        });
    </script>
</x-app-layout>
