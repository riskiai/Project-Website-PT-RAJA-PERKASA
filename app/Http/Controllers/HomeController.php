<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Models\Testimoni;
use App\Models\Mitra;
use App\Models\TentangPT;

class HomeController extends Controller
{
    public function index()
    {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan',
            'bidangproyeks'
        ])->where('status_proyek', 'disetujui')->get();

        // Decode image data for projects
        foreach ($data as $proyek) {
            $proyek->image = json_decode($proyek->image, true);
        }

        $testimonis = Testimoni::with(['user', 'mitra'])->where('status_testimoni', 'active')->get();
        $mitras = Mitra::where('status_mitra', 'active')->get();

        // Mengambil data tentang perusahaan yang aktif
        $tentang = TentangPT::where('status_tentang', 'active')->first();

        // Memecah string gambar menjadi array
        $tentangImages = explode(',', $tentang->image);

        // Menghitung jumlah klien yang puas
        $happyClients = Testimoni::where('status_testimoni', 'active')->count();

        // Menghitung jumlah proyek yang selesai
        $projectsDone = List_Data_Proyek::where('status_progres_proyek', 'selesai')->count();

        return view('Pengunjung.index', compact('data', 'testimonis', 'mitras', 'tentang', 'tentangImages', 'happyClients', 'projectsDone'));
    }
}
