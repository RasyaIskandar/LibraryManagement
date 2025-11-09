<x-app-layout>
  <section class="bg-gray-100 dark:bg-gray-900 py-6 lg:pl-64">
      <!-- Header -->
      <div class="max-w-screen-xl mx-auto px-6 lg:px-8">
          <div class="flex justify-between items-center mb-6">
              <div class="flex items-center space-x-4">
                  <span class="text-gray-600 dark:text-gray-300">{{ now()->format('l,  M Y') }}</span>
              </div>
          </div>
          <!-- Hero Section -->
          <div
              class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
              <div class="lg:w-1/3 mt-6 lg:mt-0">
                  <img src="/image/image1.png" alt="Library Illustration"
                      class="rounded-lg transition-transform duration-300">
              </div>
             
                  @if ( Auth::user()->role == 'anggota')
                  <div class="lg:w-2/3 ps-5">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Selamat Pagi, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s.
                    </p>
                  <div class="space-x-4">
                      <button
                          class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:scale-105 hover:bg-yellow-600 transition-colors duration-300">
                          <a href="{{ route('anggota.index') }}">
                          Pinjam Buku
                        </a>
                        </button>
                      <button
                          class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:scale-105 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-colors duration-300">
                        <a href="{{ route('anggota.create') }}">
                          History
                        </a>
                        </button>
                  </div>
                  @endif

                  @if (Auth::user()->role == 'admin')
                  <div class="lg:w-2/3 ps-5">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Halo, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">
                        Selamat Bekerja
                    </p>
                  <div class="space-x-4">
                    <button
                        class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:scale-105 hover:bg-yellow-600 transition-colors duration-300">
                        <a href="{{ route('books.index') }}">
                        Lemari Buku
                      </a>
                      </button>
                    <button
                        class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:scale-105 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-colors duration-300">
                      <a href="{{ route('admin.loanHistory') }}">
                        Informasi
                      </a>
                    </button>
                    <button
                        class="bg-[#85A98F] text-white px-6 py-3 rounded-lg hover:scale-105 hover:bg-[#5A6C57] dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-colors duration-300">
                      <a href="{{ route('users.index') }}">
                        Akun
                      </a>
                    </button>
                </div>
                @endif
              </div>
          </div>
      </div>
  </section>

  <!-- Dashboard Info -->
  <section class="py-8 bg-gray-100 dark:bg-gray-900 lg:pl-64">
      <div class="max-w-screen-xl mx-auto px-6 lg:px-8">
          <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Info Dashboard Buku</h2>
          <p class="text-gray-600 dark:text-gray-300 mb-6">Dashboard informasi buku total buku dipinjam, buku sedang
              dipinjam, buku dikembalikan, buku rusak</p>

          <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
              <!-- Total Buku Dipinjam -->
              <div
                  class="bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-200 p-6 rounded-lg shadow-lg flex items-center justify-between hover:scale-105 transition-transform duration-300">
                  <div>
                      <h3 class="text-2xl font-bold">78</h3>
                      <p>Total Buku Dipinjam</p>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 448 512">
                      <path
                          d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                  </svg>
              </div>

              <!-- Sedang Dipinjam -->
              <div
                  class="bg-teal-100 text-teal-800 dark:bg-teal-700 dark:text-teal-200 p-6 rounded-lg shadow-lg flex items-center justify-between hover:scale-105 transition-transform duration-300">
                  <div>
                      <h3 class="text-2xl font-bold">19</h3>
                      <p>Sedang Dipinjam</p>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 384 512">
                      <path
                          d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z" />
                  </svg>
              </div>

              <!-- Buku Dikembalikan -->
              <div
                  class="bg-orange-100 text-orange-800 dark:bg-orange-700 dark:text-orange-200 p-6 rounded-lg shadow-lg flex items-center justify-between hover:scale-105 transition-transform duration-300">
                  <div>
                      <h3 class="text-2xl font-bold">19</h3>
                      <p>Buku Dikembalikan</p>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 448 512">
                      <path
                          d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z" />
                  </svg>
              </div>

              <!-- Buku Rusak -->
              <div
                  class="bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-200 p-6 rounded-lg shadow-lg flex items-center justify-between hover:scale-105 transition-transform duration-300">
                  <div>
                      <h3 class="text-2xl font-bold">19</h3>
                      <p>Buku Rusak</p>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 576 512">
                      <path
                          d="M249.6 471.5c10.8 3.8 22.4-4.1 22.4-15.5l0-377.4c0-4.2-1.6-8.4-5-11C247.4 52 202.4 32 144 32C93.5 32 46.3 45.3 18.1 56.1C6.8 60.5 0 71.7 0 83.8L0 454.1c0 11.9 12.8 20.2 24.1 16.5C55.6 460.1 105.5 448 144 448c33.9 0 79 14 105.6 23.5zm76.8 0C353 462 398.1 448 432 448c38.5 0 88.4 12.1 119.9 22.6c11.3 3.8 24.1-4.6 24.1-16.5l0-370.3c0-12.1-6.8-23.3-18.1-27.6C529.7 45.3 482.5 32 432 32c-58.4 0-103.4 20-123 35.6c-3.3 2.6-5 6.8-5 11L304 456c0 11.4 11.7 19.3 22.4 15.5z" />
                  </svg>
              </div>
          </div>


      </div>
  </section>
</x-app-layout>