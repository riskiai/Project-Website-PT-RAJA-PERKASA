<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Models\Document_Kerjasama_Client;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
        public function index(Request $request)
        {
        // Total Karyawan
        $totalKaryawan = User::whereHas('role', function($query) {
            $query->where('role_name', 'karyawan');
        })->count();

        // Total Mitra Perusahaan
        $totalMitraPerusahaan = Document_Kerjasama_Client::where('status_kerjasama', 'diterima')->count();

        // Total Proyek Sedang Berjalan
        $totalProyekSedangBerjalan = List_Data_Proyek::where('status_progres_proyek', 'sedangberjalan')->count();

        // Total Proyek Selesai
        $totalProyekSelesai = List_Data_Proyek::where('status_progres_proyek', 'selesai')->count();

        // Data untuk Chart Proyek Berdasarkan Tahun dan Status Progres
        $currentYear = date('Y');
        $proyekByStatusAndYear = List_Data_Proyek::selectRaw('YEAR(created_at) as year, status_progres_proyek, COUNT(*) as total')
            ->groupBy('year', 'status_progres_proyek')
            ->get()
            ->groupBy('year');

        if (!isset($proyekByStatusAndYear[$currentYear])) {
            $proyekByStatusAndYear[$currentYear] = collect([]);
        }

        // Data Testimoni dengan pagination
        $testimonis = Testimoni::with(['user', 'mitra'])->paginate(3);

        // Data Proyek
        $proyeks = List_Data_Proyek::with(['materials', 'peralatan', 'bidangproyeks'])->get();

        return view('Adminstrator.dashboard.dahshboard', compact(
            'totalKaryawan', 
            'totalMitraPerusahaan', 
            'totalProyekSedangBerjalan', 
            'totalProyekSelesai',
            'proyekByStatusAndYear',
            'currentYear',
            'testimonis',
            'proyeks'
        ));
    }

}
