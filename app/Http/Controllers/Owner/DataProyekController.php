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

    public function ownerlistdataproyekupdate(Request $request, $id) {
        $request->validate([
            'status_proyek' => 'required|in:disetujui,tidak_disetujui,belumdicek',
            'keterangan_status_proyek' => 'nullable|string'
        ]);

        $proyek = List_Data_Proyek::findOrFail($id);
        $proyek->update([
            'status_proyek' => $request->status_proyek,
            'keterangan_status_proyek' => $request->keterangan_status_proyek
        ]);

        return redirect()->route('proyeklistowner')->with('success', 'Data proyek berhasil diperbarui.');
    }

    public function getProyekData($id) {
        $proyek = List_Data_Proyek::findOrFail($id);
        return response()->json($proyek);
    }
}
