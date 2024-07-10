<?php

namespace App\Http\Controllers\Owner;

use App\Exports\DataListKaryawanOwnerkWithStyle;
use App\Exports\DataListPicPerusahaanOwnerkWithStyle;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataListProyekOwnerkWithStyle;

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

    public function exportreportownerproyek() {
        return Excel::download(new DataListProyekOwnerkWithStyle(), 'List_Style_ownerproyek.xlsx');
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

    public function ownerexportreportdatakaryawan() {
        return Excel::download(new DataListKaryawanOwnerkWithStyle(), 'List_Style_ownerkaryawan.xlsx');
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

    public function ownerexportreportpicperusahaan() {
        return Excel::download(new DataListPicPerusahaanOwnerkWithStyle(), 'List_Style_ownerpic.xlsx');
    }
}
