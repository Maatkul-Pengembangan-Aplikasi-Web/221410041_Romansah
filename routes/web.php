<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdiController; // Pastikan ini ada
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalKelasController;
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
    
    Route::get('/prodi', [ProdiController::class, 'index'])->name('/prodi');
    Route::get('/prodi/search', [ProdiController::class, 'search'])->name('prodi.search');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi/create');
    Route::post('/prodi/save', [ProdiController::class, 'save'])->name('prodi/save');
    Route::get('/prodi/edit/{id}', [ProdiController::class, 'edit'])->name('prodi/edit');
    Route::put('/prodi/edit/{id}', [ProdiController::class, 'update'])->name('prodi/update');
    Route::delete('/prodi/delete/{id}', [ProdiController::class, 'delete'])->name('prodi/delete');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/matkul', [MataKuliahController::class, 'index'])->name('matkul.index');
    Route::get('/jadwal', [JadwalKelasController::class, 'index'])->name('jadwal.index');
});

require __DIR__.'/auth.php';