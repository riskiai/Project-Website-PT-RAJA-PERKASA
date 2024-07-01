<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Http\Controllers\Controller;

class ReportDataController extends Controller
{
    /* Report Data Proyek */
    public function reportownerproyek() {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->get();

        return view('Owner.reportdata.reportdataproyek', compact('data'));
    }

    /* Report Data karyawan */
    public function ownerreportdatakaryawan() {
        $data = User::with('divisi')
        ->whereHas('role', function($query) {
            $query->where('role_name', 'karyawan');
        })
        ->get();

        return view('Owner.reportdata.reportdatakaryawan', compact('data'));
    }

    /* Report Data PIC Perusahaan Dan Data Dokument Kerja Sama Client */
    public function ownerreportuserspicperusahaan() {
        $data = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan')
        ->with(['documentKerjasamaClient', 'mitra'])
        ->get();
        
        return view('Owner.reportdata.reportdatapicperusahaan', compact('data'));
    }
}
