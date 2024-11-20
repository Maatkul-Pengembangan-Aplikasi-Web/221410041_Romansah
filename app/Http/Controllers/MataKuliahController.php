<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan mata kuliah aktif
        return view('matkul.index');
    }
}
