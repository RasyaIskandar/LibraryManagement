<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Perpustakaan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">

    <div class="gap-5 bg-white shadow-2xl rounded-3xl p-12 max-w-6xl w-full flex flex-col md:flex-row items-center space-y-12 md:space-y-0 md:space-x-16 transform hover:scale-105 transition-transform duration-500">
    <div class="relative w-1/2">
      <img src="/image/bg_welcome.png" alt="Foto Siswa" class="rounded-full relative z-10 shadow-md">
      <div class="absolute bottom-4 -left-10 bg-blue-500 text-white p-3 rounded-full shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
          <path d="M19 8H5v8h14V8z" />
          <path fill-rule="evenodd" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm2 2v8h12V8H6z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="absolute top-10 -right-10 bg-blue-500 text-white p-3 rounded-full shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 4.354a4 4 0 00-2.828 1.172l-6 6a4 4 0 000 5.656 4 4 0 005.656 0l6-6A4 4 0 0012 4.354zM8.586 8.586a2 2 0 112.828 2.828l-4 4a2 2 0 11-2.828-2.828l4-4z" />
        </svg>
      </div>
    </div>

    <div class="w-1/2">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
            Selamat Datang di <br> 
            <span class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">E-Perpustakaan</span>
          </h1>
      <p class="text-xl text-gray-600 mt-4">SMK Pesat IT XPro</p>
      <div class="mt-6">
        <button class="bg-gray-800 text-white px-8 py-3 text-lg font-medium rounded-full ">
        <a href="{{ route('login') }}">
            Login
        </a>
        </button>
    </div>

    </div>
  </div>
</body>
</html>