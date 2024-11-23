<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdiController; // Pastikan ini ada
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
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
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');

    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    Route::get('/matakuliah', [MataKuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/mata-kuliah/{id}/rps', [MataKuliahController::class, 'rps'])->name('mataKuliah.rps');
    Route::get('/mata-kuliah/{id}/pertemuan', [MataKuliahController::class, 'pertemuan'])->name('mataKuliah.pertemuan');
    Route::get('/mata-kuliah/{id}/peserta', [MataKuliahController::class, 'peserta'])->name('mataKuliah.peserta');
    Route::get('/matakuliah/create', [MataKuliahController::class, 'create'])->name('mataKuliah.create');
    Route::post('/matakuliah', [MataKuliahController::class, 'store'])->name('mataKuliah.store');
    Route::delete('/matakuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mataKuliah.destroy');
    Route::get('/search', [MataKuliahController::class, 'search'])->name('mataKuliah.search'); // Pencarian
});

require __DIR__.'/auth.php';