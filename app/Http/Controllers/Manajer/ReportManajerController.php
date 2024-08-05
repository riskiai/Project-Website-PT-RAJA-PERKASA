<?php

namespace App\Http\Controllers\Manajer;


use App\Models\BidangProyek;
use App\Models\Brand_Peralatan;
use App\Models\Brand_Materials;
use Illuminate\Http\Request;
use App\Models\List_Materials;
use App\Models\List_Peralatan;
use App\Models\List_Data_Proyek;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataListProyekWithStyle;
use App\Exports\DataListMaterialskWithStyle;
use App\Exports\DataListPeralatankWithStyle;

class ReportManajerController extends Controller
{
    /* Data Report list Proyek */
    public function reportlistproyek(Request $request){
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

        return view('Manajer.report.reportdatalistproyek', compact('data', 'bidangProyeks'));
    }

    public function exportreportlistproyek(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListProyekWithStyle($filters), 'List_Style_dataproyek.xlsx');
    }

    // Data Report Materials
    public function reportlistmaterials(Request $request) {
        $query = List_Materials::with('materials', 'brand_materials', 'user');

        // Filter by created_at range
        if ($request->has('created_at_start') && !empty($request->input('created_at_start')) &&
            $request->has('created_at_end') && !empty($request->input('created_at_end'))) {
            $startDate = date('Y-m-d', strtotime($request->input('created_at_start')));
            $endDate = date('Y-m-d', strtotime($request->input('created_at_end')));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filter by expired_materials_date range
        if ($request->has('expired_materials_start') && !empty($request->input('expired_materials_start')) &&
            $request->has('expired_materials_end') && !empty($request->input('expired_materials_end'))) {
            $startDate = date('Y-m-d', strtotime($request->input('expired_materials_start')));
            $endDate = date('Y-m-d', strtotime($request->input('expired_materials_end')));
            $query->whereBetween('expired_materials_date', [$startDate, $endDate]);
        }

        // Filter by brand materials
        if ($request->has('brand_materials_id') && !empty($request->input('brand_materials_id'))) {
            $query->where('brand__materials_id', $request->input('brand_materials_id'));
        }

        $data = $query->get();
        $brandMaterials = Brand_Materials::all();

        return view('Manajer.report.reportdatalistmaterials', compact('data', 'brandMaterials'));
    }

    public function exportreportlistmaterials(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListMaterialskWithStyle($filters), 'List_Style_datamaterials.xlsx');
    }

    /* Data Report Peralatan */
    public function reportlistperalatan(Request $request) {
        $query = List_Peralatan::with('peralatan', 'brand_peralatan', 'user');

        // Filter by created_at range
        if ($request->has('created_at_start') && !empty($request->input('created_at_start')) &&
            $request->has('created_at_end') && !empty($request->input('created_at_end'))) {
            $startDate = date('Y-m-d', strtotime($request->input('created_at_start')));
            $endDate = date('Y-m-d', strtotime($request->input('created_at_end')));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filter by brand peralatan
        if ($request->has('brand_peralatan_id') && !empty($request->input('brand_peralatan_id'))) {
            $query->where('brand__peralatans_id', $request->input('brand_peralatan_id'));
        }

        // Filter by tahun beli peralatan
        if ($request->has('tahun_beli_peralatans') && !empty($request->input('tahun_beli_peralatans'))) {
            $query->whereYear('tahun_beli_peralatans', $request->input('tahun_beli_peralatans'));
        }

        $data = $query->get();
        $brandPeralatans = Brand_Peralatan::all();
        $tahunBeliPeralatans = List_Peralatan::selectRaw('YEAR(tahun_beli_peralatans) as tahun')->distinct()->pluck('tahun');

        return view('Manajer.report.reportdatalistperalatan', compact('data', 'brandPeralatans', 'tahunBeliPeralatans'));
    }

    public function exportreportlistperalatan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListPeralatankWithStyle($filters), 'List_Style_dataperalatan.xlsx');
    }
}
