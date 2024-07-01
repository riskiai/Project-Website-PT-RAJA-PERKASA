<?php

namespace App\Http\Controllers\Adminstrator;

use App\Exports\ProyekExportWithStyle;
use App\Exports\PICPerusahaanExportWithStyle;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ReportAdminController extends Controller
{
    /* Report Proyek */
    public function reportproyek() {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->get();

        return view('Adminstrator.report.reportdataproyek', compact('data'));
    }

    public function exportreportproyek(Request $request) {
        return Excel::download(new ProyekExportWithStyle(), 'List_Style_proyek.xlsx');
    }

    /* Report Data Perusahaan */
    public function reportuserspicperusahaan() {
        $data = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan')
        ->with(['documentKerjasamaClient', 'mitra'])
        ->get();
        
        return view('Adminstrator.report.reportdatausersexternal', compact('data'));
    }

    public function exportreportpicperusahaan(Request $request) {
        return Excel::download(new PICPerusahaanExportWithStyle(), 'List_Style_picperusahaan.xlsx');
    }
}
