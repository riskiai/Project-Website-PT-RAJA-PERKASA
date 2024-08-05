<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Models\Divisi;
use App\Models\BidangProyek;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;
use App\Exports\DataListProyekOwnerkWithStyle;
use App\Exports\DataListKaryawanOwnerkWithStyle;
use App\Exports\DataListPicPerusahaanOwnerkWithStyle;

class ReportDataController extends Controller
{
    /* Report Data Proyek */
    public function reportownerproyek(Request $request) {
        $query = List_Data_Proyek::with(['bidangproyeks']);

        // Filter by updated_at
        if ($request->has('updated_at') && !empty($request->input('updated_at'))) {
            $query->whereDate('updated_at', date('Y-m-d', strtotime($request->input('updated_at'))));
        }

        // Filter by bidang pekerjaan proyek
        if ($request->has('bidangproyek_id') && !empty($request->input('bidangproyek_id'))) {
            $query->where('bidangproyek_id', $request->input('bidangproyek_id'));
        }

        // Filter by status progress proyek
        if ($request->has('status_progres_proyek') && !empty($request->input('status_progres_proyek'))) {
            $query->where('status_progres_proyek', $request->input('status_progres_proyek'));
        }

        // Filter by status proyek
        if ($request->has('status_proyek') && !empty($request->input('status_proyek'))) {
            $query->where('status_proyek', $request->input('status_proyek'));
        }

        $data = $query->get();
        $bidangProyeks = BidangProyek::all();

        return view('Owner.reportdata.reportdataproyek', compact('data', 'bidangProyeks'));
    }

    public function exportreportownerproyek(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListProyekOwnerkWithStyle($filters), 'List_Style_ownerproyek.xlsx');
    }

    /* Report Data karyawan */
    public function ownerreportdatakaryawan(Request $request) {
        $query = User::with('divisi')
            ->whereHas('role', function($query) {
                $query->where('role_name', 'karyawan');
            });

        // Filter by divisi_id
        if ($request->has('divisi_id') && !empty($request->input('divisi_id'))) {
            $query->where('divisi_id', $request->input('divisi_id'));
        }

        // Filter by jenis kelamin
        if ($request->has('jk') && !empty($request->input('jk'))) {
            $query->where('jk', $request->input('jk'));
        }

        // Filter by status_user
        if ($request->has('status_user') && !empty($request->input('status_user'))) {
            $query->where('status_user', $request->input('status_user'));
        }

        $data = $query->get();
        $divisis = Divisi::all();

        return view('Owner.reportdata.reportdatakaryawan', compact('data', 'divisis'));
    }

    public function ownerexportreportdatakaryawan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListKaryawanOwnerkWithStyle($filters), 'List_Style_ownerkaryawan.xlsx');
    }

    /* Report Data PIC Perusahaan Dan Data Dokument Kerja Sama Client */
    public function ownerreportuserspicperusahaan(Request $request) {
        $query = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan', 'created_at')
        ->with(['documentKerjasamaClient', 'mitra']);
    
        // Filter by created_at range
        if ($request->has('created_at_start') && !empty($request->input('created_at_start')) &&
            $request->has('created_at_end') && !empty($request->input('created_at_end'))) {
            $startDate = date('Y-m-d', strtotime($request->input('created_at_start')));
            $endDate = date('Y-m-d', strtotime($request->input('created_at_end')));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        // Filter by status_pic_perusahaan
        if ($request->has('status_pic_perusahaan') && !empty($request->input('status_pic_perusahaan'))) {
            $query->where('status_pic_perusahaan', $request->input('status_pic_perusahaan'));
        }
    
        // Filter by status_kerjasama
        if ($request->has('status_kerjasama') && !empty($request->input('status_kerjasama'))) {
            $query->whereHas('documentKerjasamaClient', function($q) use ($request) {
                $q->where('status_kerjasama', $request->input('status_kerjasama'));
            });
        }
    
        $data = $query->get();
        
        return view('Owner.reportdata.reportdatapicperusahaan', compact('data'));
    }

    public function ownerexportreportpicperusahaan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListPicPerusahaanOwnerkWithStyle($filters), 'List_Style_ownerpic.xlsx');
    }
}
