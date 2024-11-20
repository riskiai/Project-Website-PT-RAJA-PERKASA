<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\User;
use App\Models\BidangProyek;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProyekExportWithStyle;
use App\Exports\PICPerusahaanExportWithStyle;

class ReportAdminController extends Controller
{
    /* Report Proyek */
    public function reportproyek(Request $request) {
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
        $bidangProyeks = BidangProyek::all(); // Get all project fields for the filter

        $styleBodyMain = "font-weight: bold;";

        return view('Adminstrator.report.reportdataproyek', compact('data', 'bidangProyeks', 'styleBodyMain'));
    }

    public function exportreportproyek(Request $request) {
        $filters = $request->all(); // Menerima semua filter dari request
        return Excel::download(new ProyekExportWithStyle($filters), 'List_Style_proyek.xlsx');
    }

    /* Report Data Perusahaan */
    public function reportuserspicperusahaan(Request $request) {
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
        return view('Adminstrator.report.reportdatausersexternal', compact('data'));
    }
    
    public function exportreportpicperusahaan(Request $request) {
        $filters = $request->all(); 
        return Excel::download(new PICPerusahaanExportWithStyle($filters), 'List_Style_picperusahaan.xlsx');
    }    
    

}
