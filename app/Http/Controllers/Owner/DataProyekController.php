<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\List_Data_Proyek;
use Illuminate\Http\Request;

class DataProyekController extends Controller
{
    public function proyeklistowner() {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->get();

        return view('Owner.proyek.listdataproyek', compact('data'));
    }

    public function ownershowlistdataproyek($id) {
        $proyek = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->findOrFail($id);

        return view('Owner.proyek.showdataproyek', compact('proyek'));
    }
}
