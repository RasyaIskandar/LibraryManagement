<x-app-layout>
    <section class="lg:pl-64 bg-gray-50 dark:bg-gray-900 p-5">
        <div class="container mx-auto">

            <!-- Alert Success or Error -->
            @if(session('alert'))
                <div class="p-4 mb-6 rounded-lg 
                    @if(session('alert.type') == 'create') bg-green-100 text-green-800 border-l-4 border-green-500 
                    @elseif(session('alert.type') == 'edit') bg-blue-100 text-blue-800 border-l-4 border-blue-500 
                    @elseif(session('alert.type') == 'delete') bg-red-100 text-red-800 border-l-4 border-red-500
                    @endif">
                    <p class="font-medium">{{ session('alert.message') }}</p>
                </div>
            @endif

            <!-- Header: Pencarian & Aksi -->
            <div class="flex flex-wrap justify-between items-center mb-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-4">
                <div class="flex items-center gap-2">
                    <button onclick="showCreateModal()" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:from-green-600 hover:to-green-700 transition">
                        Tambah Buku
                    </button>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Judul</th>
                                <th class="px-6 py-3">Terbit</th>
                                <th class="px-6 py-3">Penulis</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Stok</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($books as $index => $data)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $data->judul }}</td>
                                    <td class="px-6 py-4">{{ $data->tahun_terbit }}</td>
                                    <td class="px-6 py-4">{{ $data->penulis }}</td>
                                    <td class="px-6 py-4">{{ $data->kategori }}</td>
                                    <td class="px-6 py-4">{{ $data->jumlah_stok }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                            {{ $data->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $data->status ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 truncate max-w-[200px]" title="{{ $data->deskripsi }}">
                                        {{ $data->deskripsi }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <button onclick="showEditModal({{ $data->id }}, '{{ $data->judul }}', '{{ $data->penulis }}', '{{ $data->kategori }}', '{{ $data->tahun_terbit }}', '{{ $data->jumlah_stok }}', '{{ $data->status }}', '{{ $data->deskripsi }}')" class="px-3 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                            Edit
                                        </button>
                                        
                                        <button onclick="showModal({{ $data->id }}, '{{ $data->judul }}')" 
                                            class="px-3 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal Delete -->
    <div id="deleteModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                Apakah Anda yakin ingin menghapus buku <span id="bookTitle" class="font-semibold"></span>?
            </p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                    Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg transform scale-95 opacity-0 transition-all duration-300" id="editModalContent">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Edit Buku</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                        <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>
                    
                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
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

                    
                    <!-- Tahun Terbit -->
                    <div>
                        <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Terbit</label>
                        <input type="date" name="tahun_terbit" id="tahun_terbit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>
                    
                    <!-- Jumlah Stok -->
                    <div>
                        <label for="jumlah_stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Stok</label>
                        <input type="number" name="jumlah_stok" id="jumlah_stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required></textarea>
                    </div>
                </div>
                
                <!-- Modal Actions -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Create -->
    <div id="createModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg transform scale-95 opacity-0 transition-all duration-300" id="createModalContent">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Tambah Buku</h3>
            <form id="createForm" method="POST" action="{{ route('books.store') }}">
                @csrf
                <div class="space-y-4">
                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                        <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penulis</label>
                        <input type="text" name="penulis" id="penulis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-800 dark:text-white mb-2">Kategori</label>
                    <select
                        name="kategori"
                        id="kategori"
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500">
                        <option value="Novel">Novel</option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Biografi">Biografi</option>
                    </select>
                    </div>


                    <!-- Tahun Terbit -->
                    <div>
                        <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Terbit</label>
                        <input type="date" name="tahun_terbit" id="tahun_terbit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>

                    <!-- Jumlah Stok -->
                    <div>
                        <label for="jumlah_stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Stok</label>
                        <input type="number" name="jumlah_stok" id="jumlah_stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required></textarea>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeCreateModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Create
        const createModal = document.getElementById('createModal');
        const createModalContent = document.getElementById('createModalContent');

        function showCreateModal() {
            createModal.classList.remove('hidden');
            setTimeout(() => {
                createModalContent.classList.remove('scale-95', 'opacity-0');
                createModalContent.classList.add('scale-100', 'opacity-100');
            }, 100);
        }

        function closeCreateModal() {
            createModalContent.classList.add('scale-95', 'opacity-0');
            createModalContent.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                createModal.classList.add('hidden');
            }, 300);
        }

        // Modal Edit
        const editModal = document.getElementById('editModal');
        const editModalContent = document.getElementById('editModalContent');

        function showEditModal(id, judul, penulis, kategori, tahun_terbit, jumlah_stok, status, deskripsi) {
            document.getElementById('editForm').action = `/books/${id}`;
            document.getElementById('judul').value = judul;
            document.getElementById('penulis').value = penulis;
            document.getElementById('kategori').value = kategori;
            document.getElementById('tahun_terbit').value = tahun_terbit;
            document.getElementById('jumlah_stok').value = jumlah_stok;
            document.getElementById('status').value = status;
            document.getElementById('deskripsi').value = deskripsi;
            
            editModal.classList.remove('hidden');
            setTimeout(() => {
                editModalContent.classList.remove('scale-95', 'opacity-0');
                editModalContent.classList.add('scale-100', 'opacity-100');
            }, 100);
        }

        function closeEditModal() {
            editModalContent.classList.add('scale-95', 'opacity-0');
            editModalContent.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                editModal.classList.add('hidden');
            }, 300);
        }

        // Modal Delete
        const deleteModal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');

        function showModal(id, title) {
            document.getElementById('bookTitle').innerText = title;
            document.getElementById('deleteForm').action = `/books/${id}`;

            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 100);
        }

        function closeModal() {
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 300);
        }
    </script>
</x-app-layout>
