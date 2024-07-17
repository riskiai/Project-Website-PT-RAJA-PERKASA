<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Models\Testimoni;
use App\Models\Mitra;

class HomeController extends Controller
{
    public function index()
    {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->where('status_proyek', 'disetujui')->get();

        $testimonis = Testimoni::with(['user', 'mitra'])->where('status_testimoni', 'active')->get();
        $mitras = Mitra::where('status_mitra', 'active')->get();

        

        return view('Pengunjung.index', compact('data', 'testimonis', 'mitras'));
    }
}
