<?php

namespace App\Http\Controllers;

use App\Models\List_Data_Proyek;
use Illuminate\Http\Request;

class ProjectController extends Controller
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

        // Decode image data
        foreach ($data as $proyek) {
            $proyek->image = json_decode($proyek->image, true);
        }

        return view('Pengunjung.project', compact('data'));
    }
}
