<?php

namespace App\Http\Controllers\Manajer;

use App\Models\Materials;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use App\Models\Brand_Materials;
use App\Models\Brand_Peralatan;
use App\Models\List_Data_Proyek;
use App\Models\BidangProyek;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ManajerProyekListProyekController extends Controller
{
    public function listdataproyek()
    {
        $data = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan',
            'bidangproyeks'
        ])->get();

        return view('Manajer.proyekrajaperkasa.list', compact('data'));
    }

    public function showlistdataproyek($id)
    {
        $proyek = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan',
            'bidangproyeks'
        ])->findOrFail($id);

        return view('Manajer.proyekrajaperkasa.show', compact('proyek'));
    }

    public function listdataproyekcreate()
    {
        $materials = Materials::all();
        $peralatans = Peralatan::all();
        $brand_materials = Brand_Materials::all();
        $brand_peralatans = Brand_Peralatan::all();
        $bidangproyeks = BidangProyek::all();

        return view('Manajer.proyekrajaperkasa.create', compact('materials', 'peralatans', 'brand_materials', 'brand_peralatans', 'bidangproyeks'));
    }

    public function listdataproyekcreateproses(Request $request)
    {
        $request->validate([
            'bidangproyek_id' => 'required|exists:bidang_proyeks,id',
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'main_contractor' => 'required|string|max:255',
            'scope' => 'required|string|max:255',
            'start_date_proyek' => 'required|date',
            'end_date_proyek' => 'required|date',
            'value' => 'required|numeric',
            'status_progres_proyek' => 'required|in:Perencanaan,SedangBerlangsung,Penyelesaian,Pemeliharaan',
            'po' => 'required|mimes:pdf|max:2048',
            'handover' => 'required|mimes:pdf|max:2048',
            'image' => 'required',
            'image.*' => 'image|mimes:png,jpg,jpeg|max:2048',
            'materials_id' => 'required|exists:materials,id',
            'peralatans_id' => 'required|exists:peralatans,id',
            'brand__materials_id' => 'required|exists:brand__materials,id',
            'brand__peralatans_id' => 'required|exists:brand__peralatans,id',
        ]);

        DB::beginTransaction();

        try {
            $poPath = $request->file('po')->store('public/po');
            $handoverPath = $request->file('handover')->store('public/handover');
            $imagePaths = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imagePaths[] = $image->store('public/proyek/image');
                }
            }

            $proyek = List_Data_Proyek::create([
                'bidangproyek_id' => $request->bidangproyek_id,
                'project_name' => $request->project_name,
                'client_name' => $request->client_name,
                'main_contractor' => $request->main_contractor,
                'scope' => $request->scope,
                'start_date_proyek' => $request->start_date_proyek,
                'end_date_proyek' => $request->end_date_proyek,
                'value' => $request->value,
                'status_progres_proyek' => $request->status_progres_proyek,
                'po' => $poPath,
                'handover' => $handoverPath,
                'image' => json_encode($imagePaths),
                'materials_id' => $request->materials_id,
                'peralatans_id' => $request->peralatans_id,
                'brand__materials_id' => $request->brand__materials_id,
                'brand__peralatans_id' => $request->brand__peralatans_id,
            ]);

            DB::commit();

            return redirect()->route('listdataproyek')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to create project: ' . $e->getMessage()]);
        }
    }

    public function listdataproyekedit($id)
    {
        $proyek = List_Data_Proyek::findOrFail($id);
        $materials = Materials::all();
        $peralatans = Peralatan::all();
        $brand_materials = Brand_Materials::all();
        $brand_peralatans = Brand_Peralatan::all();
        $bidangproyeks = BidangProyek::all();

        return view('Manajer.proyekrajaperkasa.edit', compact('proyek', 'materials', 'peralatans', 'brand_materials', 'brand_peralatans', 'bidangproyeks'));
    }

    public function listdataproyekupdate(Request $request, $id)
    {
        $request->validate([
            'bidangproyek_id' => 'required|exists:bidang_proyeks,id',
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'main_contractor' => 'required|string|max:255',
            'scope' => 'required|string|max:255',
            'start_date_proyek' => 'required|date',
            'end_date_proyek' => 'required|date',
            'value' => 'required|numeric',
            'status_progres_proyek' => 'required|in:Perencanaan,SedangBerlangsung,Penyelesaian,Pemeliharaan',
            'po' => 'nullable|mimes:pdf|max:2048',
            'handover' => 'nullable|mimes:pdf|max:2048',
            'image' => 'nullable',
            'image.*' => 'image|mimes:png,jpg,jpeg|max:2048',
            'materials_id' => 'required|exists:materials,id',
            'peralatans_id' => 'required|exists:peralatans,id',
            'brand__materials_id' => 'required|exists:brand__materials,id',
            'brand__peralatans_id' => 'required|exists:brand__peralatans,id',
        ]);

        DB::beginTransaction();

        try {
            $proyek = List_Data_Proyek::findOrFail($id);

            if ($request->hasFile('po')) {
                Storage::delete($proyek->po);
                $poPath = $request->file('po')->store('public/po');
                $proyek->po = $poPath;
            }

            if ($request->hasFile('handover')) {
                Storage::delete($proyek->handover);
                $handoverPath = $request->file('handover')->store('public/handover');
                $proyek->handover = $handoverPath;
            }

            if ($request->hasFile('image')) {
                $images = json_decode($proyek->image, true);
                if ($images) {
                    foreach ($images as $image) {
                        Storage::delete($image);
                    }
                }
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    $imagePaths[] = $image->store('public/proyek/image');
                }
                $proyek->image = json_encode($imagePaths);
            }

            $proyek->update([
                'bidangproyek_id' => $request->bidangproyek_id,
                'project_name' => $request->project_name,
                'client_name' => $request->client_name,
                'main_contractor' => $request->main_contractor,
                'scope' => $request->scope,
                'start_date_proyek' => $request->start_date_proyek,
                'end_date_proyek' => $request->end_date_proyek,
                'value' => $request->value,
                'status_progres_proyek' => $request->status_progres_proyek,
                'materials_id' => $request->materials_id,
                'peralatans_id' => $request->peralatans_id,
                'brand__materials_id' => $request->brand__materials_id,
                'brand__peralatans_id' => $request->brand__peralatans_id,
            ]);

            DB::commit();

            return redirect()->route('listdataproyek')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to update project: ' . $e->getMessage()]);
        }
    }

    public function listdataproyekdelete($id)
    {
        $proyek = List_Data_Proyek::findOrFail($id);

        DB::beginTransaction();

        try {
            Storage::delete($proyek->po);
            Storage::delete($proyek->handover);

            $images = json_decode($proyek->image, true);
            if ($images) {
                foreach ($images as $image) {
                    Storage::delete($image);
                }
            }

            $proyek->delete();

            DB::commit();

            return redirect()->route('listdataproyek')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to delete project: ' . $e->getMessage()]);
        }
    }
}
