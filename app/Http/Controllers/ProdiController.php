<?php

namespace App\Http\Controllers;

use App\Models\Prodi; // Mengimpor model Prodi dengan benar
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Menampilkan daftar Program Studi
    public function index()
    {
        // Mengambil semua Program Studi dan mengurutkannya berdasarkan ID
        $prodis = Prodi::orderBy('id', 'desc')->get();
        return view('prodi.index', compact('prodis'));
    }

    // Menambahkan fungsi pencarian
    public function search(Request $request)
    {
        $search = $request->input('search'); // Mengambil input pencarian
        $prodis = Prodi::query()
            ->where('nama', 'like', "%{$search}%") // Filter berdasarkan nama
            ->orderBy('id', 'desc')
            ->get();

        return view('prodi.index', compact('prodis', 'search'));
    }

    // Menampilkan formulir untuk menambahkan Program Studi
    public function create()
    {
        return view('prodi.create');
    }

    // Menyimpan Program Studi baru
    public function save(Request $request)
    {
        $request->validate([
            'nama' => 'required' // Validasi bahwa nama diperlukan
        ]);

        Prodi::create([
            'nama' => $request->nama // Menyimpan nama Program Studi
        ]);

        // Redirect ke halaman utama Program Studi
        return redirect('/prodi')->with('success', 'Program Studi berhasil ditambahkan');
    }

    // Menampilkan formulir untuk mengedit Program Studi
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('prodi.edit', compact('prodi'));
    }

    // Memperbarui data Program Studi
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update([
            'nama' => $request->nama
        ]);

        // Redirect ke halaman utama Program Studi
        return redirect('/prodi')->with('success', 'Program Studi berhasil diperbarui');
    }

    // Menghapus data Program Studi
    public function delete($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        // Redirect ke halaman utama Program Studi
        return redirect('/prodi')->with('success', 'Data Program Studi berhasil dihapus');
    }

    
}
