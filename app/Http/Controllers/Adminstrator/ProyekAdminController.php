<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use App\Models\List_Data_Proyek;
use Illuminate\Http\Request;

class ProyekAdminController extends Controller
{
    public function index()
    {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan',
            'bidangproyeks'
        ])->orderBy('updated_at', 'desc')->get();

        return view('Adminstrator.proyek.list', compact('data'));
    }

    public function adminstratorshowlistdataproyek($id)
    {
        $proyek = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ])->findOrFail($id);

        return view('Adminstrator.proyek.show', compact('proyek'));
    }

    public function adminstratorlistdataproyekedit($id)
    {
        $proyek = List_Data_Proyek::findOrFail($id);
        return view('Adminstrator.proyek.edit', compact('proyek'));
    }

    public function adminstratorlistdataproyekupdate(Request $request, $id)
    {
        $request->validate([
            'status_proyek' => 'required|in:disetujui,tidak_disetujui,belumdicek',
            'keterangan_status_proyek' => 'nullable|string'
        ]);

        $proyek = List_Data_Proyek::findOrFail($id);
        $proyek->update([
            'status_proyek' => $request->status_proyek,
            'keterangan_status_proyek' => $request->keterangan_status_proyek
        ]);

        return redirect()->route('proyeklist')->with('success', 'Data proyek berhasil diperbarui.');
    }

    public function getProyekData($id)
    {
        $proyek = List_Data_Proyek::findOrFail($id);
        return response()->json($proyek);
    }
}
