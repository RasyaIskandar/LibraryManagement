<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center px-4">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-3xl">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 flex items-center gap-2">
                <i class="fas fa-book"></i>
                Tambah Buku
            </h2>
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Judul Buku -->
                    <div class="col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Judul Buku</label>
                        <div class="relative">
                            <input
                                type="text"
                                name="judul"
                                id="judul"
                                placeholder="Judul Buku"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                                required
                            />
                            <i class="fas fa-pen absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Penulis</label>
                        <div class="relative">
                            <input
                                type="text"
                                name="penulis"
                                id="penulis"
                                placeholder="Penulis"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                                required
                            />
                            <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Kategori</label>
                        <select
                            name="kategori"
                            id="kategori"
                            class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="Novel">Novel</option>
                            <option value="Fiksi">Fiksi</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Sejarah">Sejarah</option>
                            <option value="Biografi">Biografi</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Status</label>
                        <select
                            name="status"
                            id="status"
                            class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>

                    <!-- Tahun Terbit -->
                    <div>
                        <label for="tahun_terbit" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Tahun Terbit</label>
                        <div class="relative">
                            <input
                                type="date"
                                name="tahun_terbit"
                                id="tahun_terbit"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                                required
                            />
                            <i class="fas fa-calendar-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>

                    <!-- Jumlah Stok -->
                    <div>
                        <label for="jumlah_stok" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Jumlah Stok</label>
                        <div class="relative">
                            <input
                                type="number"
                                name="jumlah_stok"
                                id="jumlah_stok"
                                placeholder="Stok"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                                required
                            />
                            <i class="fas fa-boxes absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Deskripsi</label>
                        <div class="relative">
                            <textarea
                                name="deskripsi"
                                id="deskripsi"
                                rows="4"
                                placeholder="Deskripsi buku"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500"
                                required
                            ></textarea>
                            <i class="fas fa-align-left absolute right-3 top-3 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>
                </div>

                <!-- Button Submit -->
                <button
                    type="submit"
                    class="w-full mt-6 py-3 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-700"
                >
                    Tambah Buku
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
