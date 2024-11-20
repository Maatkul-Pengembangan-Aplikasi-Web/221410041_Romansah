<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalKelasController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan jadwal kelas
        return view('jadwal.index');
    }
}
