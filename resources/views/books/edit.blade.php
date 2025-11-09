<x-app-layout>
    <section class="bg-white dark:bg-gray-900 py-8 px-4">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">Edit Buku</h2>
            <form action="{{ route('books.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Kolom 1 -->
                    <div>
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                        <input value="{{ $data->judul }}" type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-500 dark:text-white" placeholder="Judul Buku" required>
                    </div>
                    <div>
                        <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                        <input value="{{ $data->penulis }}" type="text" name="penulis" id="penulis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-500 dark:text-white" placeholder="Penulis" required>
                    </div>
                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                            <option value="Novel" {{ $data->kategori == 'Novel' ? 'selected' : '' }}>Novel</option>
                            <option value="Fiksi" {{ $data->kategori == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                            <option value="Pendidikan" {{ $data->kategori == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Sejarah" {{ $data->kategori == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="Biografi" {{ $data->kategori == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Tersedia</option>
                            <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahun_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit</label>
                        <input value="{{ $data->tahun_terbit }}" type="date" name="tahun_terbit" id="tahun_terbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-500 dark:text-white" required>
                    </div>
                    <div>
                        <label for="jumlah_stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok</label>
                        <input value="{{ $data->jumlah_stok }}" type="number" name="jumlah_stok" id="jumlah_stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-500 dark:text-white" placeholder="Jumlah Stok" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-500 dark:text-white" placeholder="Deskripsi Buku" required>{{ $data->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition-transform transform hover:scale-105">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
