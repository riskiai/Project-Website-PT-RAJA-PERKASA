<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontakPT;

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil data kontak yang aktif
        $kontak = KontakPT::where('status_kontak', 'active')->first();
        
        // Mengirim data ke view
        return view('Pengunjung.kontak', compact('kontak'));
    }
}
