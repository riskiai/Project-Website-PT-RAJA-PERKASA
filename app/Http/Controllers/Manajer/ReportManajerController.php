<?php

namespace App\Http\Controllers\Manajer;


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
    public function reportlistproyek(){
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->get();

        return view('Manajer.report.reportdatalistproyek', compact('data'));
    }

    public function exportreportlistproyek(Request $request) {
        return Excel::download(new DataListProyekWithStyle(), 'List_Style_dataproyek.xlsx');
    }

    // Data Report Materials
    public function reportlistmaterials() {
        $data = List_Materials::with('materials', 'brand_materials', 'user')->get();
        return view('Manajer.report.reportdatalistmaterials', compact('data'));
    }

    public function exportreportlistmaterials() {
        return Excel::download(new DataListMaterialskWithStyle(), 'List_Style_datamaterials.xlsx');
    }

    /* Data Report Peralatan */
    public function reportlistperalatan() {
        $data = List_Peralatan::with('peralatan', 'brand_peralatan', 'user')->get();
        return view('Manajer.report.reportdatalistperalatan', compact('data'));
    }

    public function exportreportlistperalatan() {
        return Excel::download(new DataListPeralatankWithStyle(), 'List_Style_dataperalatan.xlsx');
    }
}
