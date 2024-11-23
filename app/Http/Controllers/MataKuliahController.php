<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah; // Pastikan Model diimport
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // Menampilkan daftar mata kuliah
    public function index()
    {
        $mataKuliah = MataKuliah::all(); // Ambil data mata kuliah dari database
        return view('matakuliah.matakuliah', compact('mataKuliah')); // Kirim ke view
    }

    // Menampilkan RPS untuk mata kuliah
    public function rps($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id); // Temukan data atau gagal
        return view('mataKuliah.rps', compact('mataKuliah')); // Kirim ke view
    }

    // Menampilkan daftar pertemuan kuliah
    public function pertemuan($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id); // Temukan data atau gagal
        return view('mataKuliah.pertemuan', compact('mataKuliah')); // Kirim ke view
    }

    // Menampilkan daftar peserta
    public function peserta($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id); // Temukan data atau gagal
        return view('mataKuliah.peserta', compact('mataKuliah')); // Kirim ke view
    }

    public function create()
{
    return view('matakuliah.create'); // Tampilkan form tambah data
}

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'kode' => 'required|string|max:10',
        'sks' => 'required|integer',
        'dosen' => 'required|string|max:255',
    ]);

    // Simpan data ke database
    MataKuliah::create([
        'nama' => $request->nama,
        'kode' => $request->kode,
        'sks' => $request->sks,
        'dosen' => $request->dosen,
    ]);

    return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
}
public function destroy($id)
{
    $mataKuliah = MataKuliah::findOrFail($id);
    $mataKuliah->delete();

    return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
}
public function search(Request $request)
{
    $search = $request->input('search');
    
    // Cari mata kuliah berdasarkan nama atau kode
    $mataKuliah = MataKuliah::where('nama', 'like', "%{$search}%")
                            ->orWhere('kode', 'like', "%{$search}%") // Perbaikan di sini
                            ->get();
    
    return view('matakuliah.matakuliah', compact('mataKuliah')); // Pastikan view yang benar
}


}
