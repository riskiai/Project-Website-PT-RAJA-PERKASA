<?php

namespace App\Http\Controllers\Manajer;

use App\Models\Materials;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\List_Materials;
use App\Models\Brand_Materials;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ManajerProyekMaterialsController extends Controller
{
    /* Materials */
    public function materials()
    {
        $data = Materials::all();
        return view('Manajer.materialsrajaperkasa.materials.list', compact('data'));
    }

    public function create()
    {
        return view('Manajer.materialsrajaperkasa.materials.create');
    }

    public function createproses(Request $request)
    {
        $request->validate([
            'nama_materials' => 'required|string|max:255',
            'qty' => 'required|string|max:255',
            'status_materials' => 'required|in:tersedia,tidak_tersedia',
        ]);

        Materials::create([
            'nama_materials' => $request->nama_materials,
            'qty' => $request->qty,
            'status_materials' => $request->status_materials,
        ]);

        return redirect()->route('materialslist')->with('success', 'Data materials berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $materials = Materials::findOrFail($id);
        return view('Manajer.materialsrajaperkasa.materials.edit', compact('materials'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_materials' => 'required|string|max:255',
            'qty' => 'required|string|max:255',
            'status_materials' => 'required|in:tersedia,tidak_tersedia',
        ]);

        $materials = Materials::findOrFail($id);
        $materials->update([
            'nama_materials' => $request->nama_materials,
            'qty' => $request->qty,
            'status_materials' => $request->status_materials,
        ]);

        return redirect()->route('materialslist')->with('success', 'Data materials berhasil diperbarui.');
    }

    public function delete($id)
    {
        $peralatan = Materials::findOrFail($id);
        $peralatan->delete();

        return redirect()->route('materialslist')->with('success', 'Data Materials berhasil dihapus.');
    }

     /* Brand Materials */
     public function brandmaterials()
     {
         $data = Brand_Materials::all();
         return view('Manajer.materialsrajaperkasa.brandmaterials.list', compact('data'));
     }

     public function brandcreate()
     {
         return view('Manajer.materialsrajaperkasa.brandmaterials.create');
     }
 
     public function brandcreateproses(Request $request)
     {
         $request->validate([
             'nama_brand_materials' => 'required|string|max:255',
             'status_brand_materials' => 'required|in:active,nonactive',
         ]);
 
         Brand_Materials::create([
             'nama_brand_materials' => $request->nama_brand_materials,
             'status_brand_materials' => $request->status_brand_materials,
         ]);
 
         return redirect()->route('brandmaterialslist')->with('success', 'Data brand materials berhasil ditambahkan.');
     }

     public function brandedit($id)
     {
         $brandMaterial = Brand_Materials::findOrFail($id);
         return view('Manajer.materialsrajaperkasa.brandmaterials.edit', compact('brandMaterial'));
     }
 
     public function brandupdate(Request $request, $id)
     {
         $request->validate([
             'nama_brand_materials' => 'required|string|max:255',
             'status_brand_materials' => 'required|in:active,nonactive',
         ]);
 
         $brandMaterial = Brand_Materials::findOrFail($id);
         $brandMaterial->update([
             'nama_brand_materials' => $request->nama_brand_materials,
             'status_brand_materials' => $request->status_brand_materials,
         ]);
 
         return redirect()->route('brandmaterialslist')->with('success', 'Data brand materials berhasil diperbarui.');
     }

     public function branddelete($id) 
     {
        $brand_peralatans = Brand_Materials::findOrFail($id);
        $brand_peralatans->delete();

        return redirect()->route('brandmaterialslist')->with('success', 'Data Materials berhasil dihapus.');
     }

     /* List Data Materials */
     public function listdatamaterials()
     {
         $data = List_Materials::with('materials', 'brand_materials', 'user')->get();
         return view('Manajer.materialsrajaperkasa.listmaterials.list', compact('data'));
     }

     public function showlistdatamaterials($id)
    {
        $listMaterial = List_Materials::with('materials', 'brand_materials', 'user')->findOrFail($id);
        return view('Manajer.materialsrajaperkasa.listmaterials.show', compact('listMaterial'));
    }

     public function listdatacreate()
     {
         $materials = Materials::all();
         $brands = Brand_Materials::all();
         return view('Manajer.materialsrajaperkasa.listmaterials.create', compact('materials', 'brands'));
     }
 
     public function listdatacreateproses(Request $request)
     {
         $request->validate([
             'materials_id' => 'required',
             'brand__materials_id' => 'required',
             'countries' => 'required|string|max:255',
             'tkdn' => 'required|string|max:255',
             'tknd_certificate' => 'required|mimes:pdf',
             'tools_certificate_materials' => 'required|mimes:pdf',
             'expired_materials_date' => 'required|date',
             'status_list_materials' => 'required|in:active,nonactive',
         ]);
 
         // Mendapatkan nama material
         $material = Materials::find($request->materials_id);
 
         if ($request->hasFile('tknd_certificate')) {
             $file = $request->file('tknd_certificate');
             $filename = 'tkdn_certificate_' . Str::slug($material->nama_materials, '_') . '.pdf';
             $filePath = $file->storeAs('public/tkdn_certificates', $filename);
         } else {
             $filePath = null;
         }

         if ($request->hasFile('tools_certificate_materials')) {
            $file = $request->file('tools_certificate_materials');
            $filename = 'tools_certificate_materials_' . Str::slug($material->nama_materials, '_') . '.pdf';
            $filePath = $file->storeAs('public/tools_certificate_materials', $filename);
        } else {
            $filePath = null;
        }
 
         List_Materials::create([
             'user_id' => auth()->user()->id,
             'materials_id' => $request->materials_id,
             'brand__materials_id' => $request->brand__materials_id,
             'countries' => $request->countries,
             'tkdn' => $request->tkdn,
             'tknd_certificate' => $filePath,
             'tools_certificate_materials' => $filePath,
             'expired_materials_date' => $request->expired_materials_date,
             'status_list_materials' => $request->status_list_materials,
         ]);
 
         return redirect()->route('listdatamaterials')->with('success', 'Data materials berhasil ditambahkan.');
     }

    public function listdataedit($id)
    {
        $listMaterial = List_Materials::findOrFail($id);
        $materials = Materials::all();
        $brands = Brand_Materials::all();
        return view('Manajer.materialsrajaperkasa.listmaterials.edit', compact('listMaterial', 'materials', 'brands'));
    }

    public function listdataupdate(Request $request, $id)
    {
        $request->validate([
            'materials_id' => 'required',
            'brand__materials_id' => 'required',
            'countries' => 'required|string|max:255',
            'tkdn' => 'required|string|max:255',
            'tknd_certificate' => 'nullable|mimes:pdf',
            'tools_certificate_materials' => 'required|mimes:pdf',
            'expired_materials_date' => 'required|date',
            'status_list_materials' => 'required|in:active,nonactive',
        ]);

        $listMaterial = List_Materials::findOrFail($id);
        $material = Materials::find($request->materials_id);

        if ($request->hasFile('tknd_certificate')) {
            if ($listMaterial->tknd_certificate) {
                Storage::delete($listMaterial->tknd_certificate);
            }
            $file = $request->file('tknd_certificate');
            $filename = 'tkdn_certificate_' . Str::slug($material->nama_materials, '_') . '.pdf';
            $filePath = $file->storeAs('public/tkdn_certificates', $filename);
            $listMaterial->tknd_certificate = $filePath;
        }
        
        if ($request->hasFile('tools_certificate_materials')) {
            if ($listMaterial->tools_certificate_materials) {
                Storage::delete($listMaterial->tools_certificate_materials);
            }
            $file = $request->file('tools_certificate_materials');
            $filename = 'tools_certificate_materials_' . Str::slug($material->nama_materials, '_') . '.pdf';
            $filePath = $file->storeAs('public/tools_certificate_materials', $filename);
            $listMaterial->tools_certificate_materials = $filePath;
        }

        $listMaterial->update([
            'materials_id' => $request->materials_id,
            'brand__materials_id' => $request->brand__materials_id,
            'countries' => $request->countries,
            'tkdn' => $request->tkdn,
            'expired_materials_date' => $request->expired_materials_date,
            'status_list_materials' => $request->status_list_materials,
        ]);

        return redirect()->route('listdatamaterials')->with('success', 'Data materials berhasil diperbarui.');
    }

    public function listdatadelete($id) {
        $listdata_peralatans = List_Materials::findOrFail($id);
        $listdata_peralatans->delete();

        return redirect()->route('listdatamaterials')->with('success', 'Data Materials berhasil dihapus.');
    }
}
