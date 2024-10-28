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

        return redirect()->route('prodi')->with('success', 'Program Studi berhasil ditambahkan');
    }
    public function edit($id)
{
    $prodi = Prodi::findOrFail($id);
    return view('prodi.edit', compact('prodi'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required'
    ]);

    $prodi = Prodi::findOrFail($id);
    $prodi->update([
        'nama' => $request->nama
    ]);

    return redirect()->route('prodi')->with('success', 'Program Studi berhasil diupdated');
}
public function delete($id)
{
    $prodi = Prodi::findOrFail($id);
    $prodi->delete();

    return redirect()->route('prodi')->with('success', 'Data Program Studi berhasil dihapus');
}
}
