<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MahasiswaController extends Controller
{
    // Menampilkan form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.tambah-mahasiswa'); // Pastikan nama file view sesuai
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|max:100',
            'npm' => 'required|unique:mahasiswas,npm|max:50',
            'prodi' => 'required|max:100',
            'foto' => 'nullable|image|max:2048', // Validasi file foto (opsional)
        ]);

        // Menyimpan file foto jika ada
        $path = null;
        if ($request->hasFile('foto')) {
            // Simpan file ke folder 'foto_mahasiswa' di storage/app/public
            $path = $request->file('foto')->store('public/foto_mahasiswa');
        }

        // Menambahkan data mahasiswa ke database
        Mahasiswa::create([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'prodi' => $request->prodi,
            'foto' => $path ? str_replace('public/', '', $path) : null, // Simpan path relatif
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // Menampilkan data mahasiswa atau melakukan pencarian
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        // Cek jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            // Tambahkan kondisi pencarian
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%")
                  ->orWhere('prodi', 'like', "%{$search}%");
        }

        // Ambil data mahasiswa
        $mahasiswa = $query->get();

        return view('mahasiswa.mahasiswa', compact('mahasiswa'));
    }

    // Menampilkan form edit mahasiswa
    public function edit($id)
    {
        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.edit-mahasiswa', compact('mahasiswa'));
    }

    // Mengupdate data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|max:100',
            'npm' => 'required|unique:mahasiswas,npm,' . $id . '|max:50', // Validasi unik kecuali data saat ini
            'prodi' => 'required|max:100',
            'foto' => 'nullable|image|max:2048', // Validasi foto baru (jika diunggah)
        ]);

        // Proses jika ada foto baru yang diunggah
        if ($request->hasFile('foto')) {
            // Simpan file ke folder 'foto_mahasiswa'
            $path = $request->file('foto')->store('public/foto_mahasiswa');
            $mahasiswa->foto = str_replace('public/', '', $path); // Perbarui path foto
        }

        // Update data mahasiswa
        $mahasiswa->update([
            'nama' => $request->nama,
            'npm' => $request->npm,
            'prodi' => $request->prodi,
            'foto' => $mahasiswa->foto, // Tetap gunakan foto lama jika tidak diubah
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hapus data mahasiswa
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
