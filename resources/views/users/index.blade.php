<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 lg:pl-64">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Container -->
            <div class="bg-white dark:bg-gray-800 relative shadow-lg rounded-xl overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Daftar Anggota</h2>
                    <div class="flex space-x-3">
                        <!-- Modal toggle -->
                        <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg text-sm px-6 py-2.5 transition-all">
                            Tambah Anggota
                        </button>
                    </div>
                </div>

                <!-- Alert Success -->
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Alert Error -->
                @if(session('error'))
                    <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Modal -->
                <div id="defaultModal" tabindex="-1" aria-hidden="true"
                    class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
                        <div class="flex justify-between items-center border-b pb-4 mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tambah Anggota</h3>
                            <button type="button" class="text-gray-400 hover:text-gray-800 dark:hover:text-white"
                                data-modal-toggle="defaultModal">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Form -->
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <button type="submit"
                                    class="bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg px-5 py-2.5 transition-all">
                                    Tambah Anggota
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="overflow-x-auto p-6">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->role }}</td>
                                    <td class="px-6 py-4 flex justify-end space-x-3">
                                        <!-- Tombol Edit -->
                                        <button data-modal-target="editModal-{{ $user->id }}" data-modal-toggle="editModal-{{ $user->id }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.72 18.993a4.5 4.5 0 01-1.89 1.13l-3.218.924.924-3.218a4.5 4.5 0 011.13-1.89l12.084-12.084z" />
                                            </svg>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button data-modal-target="deleteModal-{{ $user->id }}" data-modal-toggle="deleteModal-{{ $user->id }}"
                                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 5.25L19.5 21H4.5L3.75 5.25M10.5 9.75v6m3-6v6m8.25-7.5h-17.5M15.75 5.25h-7.5m7.5 0a2.25 2.25 0 00-7.5 0" />
                                            </svg>
                                        </button>

                                        <!-- Modal Edit -->
<div id="editModal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Edit Anggota</h3>
            <button type="button" class="text-gray-400 hover:text-gray-800 dark:hover:text-white"
                data-modal-toggle="editModal-{{ $user->id }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <!-- Form Edit -->
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                </div>
                <!-- Tambahkan Password untuk Edit -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg px-5 py-2.5 transition-all">
                    Update Anggota
                </button>
            </div>
        </form>
    </div>
</div>


                                        <!-- Modal Delete -->
                                        <div id="deleteModal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
                                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
                                                <div class="flex justify-between items-center border-b pb-4 mb-4">
                                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Hapus Anggota</h3>
                                                    <button type="button" class="text-gray-400 hover:text-gray-800 dark:hover:text-white"
                                                        data-modal-toggle="deleteModal-{{ $user->id }}">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- Konfirmasi Hapus -->
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-sm text-gray-700 dark:text-gray-300">
                                                        Apakah Anda yakin ingin menghapus anggota ini? Aksi ini tidak bisa dibatalkan.
                                                    </div>
                                                    <div class="mt-6 flex justify-end space-x-4">
                                                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg px-5 py-2.5"
                                                            data-modal-toggle="deleteModal-{{ $user->id }}">
                                                            Batal
                                                        </button>
                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg px-5 py-2.5">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
