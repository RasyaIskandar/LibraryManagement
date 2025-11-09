<?php

use App\Http\Controllers\anggotaController;
use App\Http\Controllers\bookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\usersController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('books', bookController::class);
    Route::resource('users', usersController::class);  
    Route::get('/admin/loanHistory', [anggotaController::class, 'loanHistory'])->name('admin.loanHistory');
   Route::patch('/pinjam/perpanjang/{pinjam}', [anggotaController::class, 'perpanjangTanggal'])->name('pinjam.perpanjang');
Route::post('/pinjam/kembalikanpaksa/{id}', [anggotaController::class, 'kembalikanPaksa'])->name('pinjam.kembalikanPaksa');
});

Route::group(['middleware' => ['auth', 'role:anggota']], function () {
    Route::resource('anggota', anggotaController::class);
    Route::put('kembalikanBuku/{pinjam}', [anggotaController::class, 'kembalikanBuku'])->name('anggota.kembalikan');
});



require __DIR__.'/auth.php';
