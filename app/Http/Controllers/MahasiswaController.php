<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan jumlah mahasiswa
        return view('mahasiswa.index');
    }
}
