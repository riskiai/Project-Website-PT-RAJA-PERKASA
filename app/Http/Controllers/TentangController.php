<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Models\Testimoni;
use App\Models\TentangPT;

class TentangController extends Controller
{
    public function index() {
        // Mengambil data tentang perusahaan yang aktif
        $tentang = TentangPT::where('status_tentang', 'active')->first();

        // Memecah string gambar menjadi array
        $tentangImages = explode(',', $tentang->image);

        // Mengambil gambar sertifikat (index 2, 3, dan 4)
        $sertifikatImages = array_slice($tentangImages, 1, 3);

        // Menghitung jumlah klien yang puas
        $happyClients = Testimoni::where('status_testimoni', 'active')->count();

        // Menghitung jumlah proyek yang selesai
        $projectsDone = List_Data_Proyek::where('status_progres_proyek', 'selesai')->count();

        return view('Pengunjung.tentang', compact('tentang', 'sertifikatImages', 'happyClients', 'projectsDone'));
    }
}
