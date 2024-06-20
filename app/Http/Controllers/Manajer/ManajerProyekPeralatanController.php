<?php

namespace App\Http\Controllers\Manajer;

use App\Models\Peralatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\List_Peralatan;
use App\Models\Brand_Peralatan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ManajerProyekPeralatanController extends Controller
{

    /* Peralatan */
    public function peralatan()
    {
        $data = Peralatan::all();
        return view('Manajer.peralatansrajaperkasa.peralatans.list', compact('data'));
    }

    public function create()
    {
        return view('Manajer.peralatansrajaperkasa.peralatans.create');
    }

    public function createproses(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_peralatan' => 'required|string|max:255',
            'status_peralatans' => 'required|in:berfungsi,tidakberfungsi',
        ]);

        // Simpan data ke database
        Peralatan::create([
            'nama_peralatan' => $request->nama_peralatan,
            'status_peralatans' => $request->status_peralatans,
        ]);

        return redirect()->route('peralatanlist')->with('success', 'Data peralatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $peralatan = Peralatan::findOrFail($id);
        return view('Manajer.peralatansrajaperkasa.peralatans.edit', compact('peralatan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_peralatan' => 'required|string|max:255',
            'status_peralatans' => 'required|in:berfungsi,tidakberfungsi',
        ]);

        // Update data di database
        $peralatan = Peralatan::findOrFail($id);
        $peralatan->update([
            'nama_peralatan' => $request->nama_peralatan,
            'status_peralatans' => $request->status_peralatans,
        ]);

        return redirect()->route('peralatanlist')->with('success', 'Data peralatan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $peralatan = Peralatan::findOrFail($id);
        $peralatan->delete();

        return redirect()->route('peralatanlist')->with('success', 'Data peralatan berhasil dihapus.');
    }

    /* Brand Peralatan */
    public function brandperalatan()
    {
        $data = Brand_Peralatan::all();
        return view('Manajer.peralatansrajaperkasa.brandperalatans.list', compact('data'));
    }

    public function createbrand()
    {
        return view('Manajer.peralatansrajaperkasa.brandperalatans.create');
    }

    public function createbrandproses(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_brand_peralatan' => 'required|string|max:255',
            'status_brand_peralatans' => 'required|in:active,nonactive',
        ]);

        // Simpan data ke database
        Brand_Peralatan::create([
            'nama_brand_peralatan' => $request->nama_brand_peralatan,
            'status_brand_peralatans' => $request->status_brand_peralatans,
        ]);

        return redirect()->route('brandperalatanlist')->with('success', 'Data brand peralatan berhasil ditambahkan.');
    }

    public function editbrand($id)
    {
        $brand = Brand_Peralatan::findOrFail($id);
        return view('Manajer.peralatansrajaperkasa.brandperalatans.edit', compact('brand'));
    }

    public function updatebrand(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_brand_peralatan' => 'required|string|max:255',
            'status_brand_peralatans' => 'required|in:active,nonactive',
        ]);

        // Update data di database
        $brand = Brand_Peralatan::findOrFail($id);
        $brand->update([
            'nama_brand_peralatan' => $request->nama_brand_peralatan,
            'status_brand_peralatans' => $request->status_brand_peralatans,
        ]);

        return redirect()->route('brandperalatanlist')->with('success', 'Data brand peralatan berhasil diperbarui.');
    }

    public function deletebrand($id)
    {
        $brand = Brand_Peralatan::findOrFail($id);
        $brand->delete();

        return redirect()->route('brandperalatanlist')->with('success', 'Data brand peralatan berhasil dihapus.');
    }

    /* Data List Peralatan */
    public function listdataperalatan()
    {
        $data = List_Peralatan::with('peralatan', 'brand_peralatan', 'user')->get();
        return view('Manajer.peralatansrajaperkasa.listperalatans.list', compact('data'));
    }

    public function showlistdataperalatans($id)
    {
        $listPeralatan = List_Peralatan::with('peralatan', 'brand_peralatan', 'user')->findOrFail($id);
        return view('Manajer.peralatansrajaperkasa.listperalatans.show', compact('listPeralatan'));
    }


    public function createlistdataperalatan()
    {
        $peralatans = Peralatan::all();
        $brands = Brand_Peralatan::all();
        return view('Manajer.peralatansrajaperkasa.listperalatans.create', compact('peralatans', 'brands'));
    }

    public function createlistdataperalatanproses(Request $request)
    {
        $request->validate([
            'peralatans_id' => 'required',
            'brand__peralatans_id' => 'required',
            'capacity' => 'required',
            'tahun_beli_peralatans' => 'required|date',
            'ownership' => 'required',
            'tools_certificate' => 'required|mimes:pdf',
            'certificate_expired_date' => 'required|date',
            'certificate_by' => 'required',
            'unit_qty' => 'required',
            'status_list_peralatans' => 'required|in:active,nonactive',
        ]);

        // Mendapatkan nama peralatan
        $peralatan = Peralatan::find($request->peralatans_id);

        if ($request->hasFile('tools_certificate')) {
            $file = $request->file('tools_certificate');
            $filename = 'tools_certificate_' . Str::slug($peralatan->nama_peralatan, '_') . '.pdf';
            $filePath = $file->storeAs('public/tools_certificates', $filename);
        } else {
            $filePath = null;
        }

        List_Peralatan::create([
            'user_id' => auth()->user()->id,
            'peralatans_id' => $request->peralatans_id,
            'brand__peralatans_id' => $request->brand__peralatans_id,
            'capacity' => $request->capacity,
            'tahun_beli_peralatans' => $request->tahun_beli_peralatans,
            'ownership' => $request->ownership,
            'tools_certificate' => $filePath,
            'certificate_expired_date' => $request->certificate_expired_date,
            'certificate_by' => $request->certificate_by,
            'unit_qty' => $request->unit_qty,
            'status_list_peralatans' => $request->status_list_peralatans,
        ]);

        return redirect()->route('listdataperalatan')->with('success', 'Data peralatan berhasil ditambahkan.');
    }

    public function editlistdataperalatan($id)
    {
        $listPeralatan = List_Peralatan::findOrFail($id);
        $peralatans = Peralatan::all();
        $brands = Brand_Peralatan::all();
        return view('Manajer.peralatansrajaperkasa.listperalatans.edit', compact('listPeralatan', 'peralatans', 'brands'));
    }

    public function updatelistdataperalatan(Request $request, $id)
    {
        $request->validate([
            'peralatans_id' => 'required',
            'brand__peralatans_id' => 'required',
            'capacity' => 'required',
            'tahun_beli_peralatans' => 'required|date',
            'ownership' => 'required',
            'tools_certificate' => 'nullable|mimes:pdf',
            'certificate_expired_date' => 'required|date',
            'certificate_by' => 'required',
            'unit_qty' => 'required',
            'status_list_peralatans' => 'required|in:active,nonactive',
        ]);

        $listPeralatan = List_Peralatan::findOrFail($id);
        $peralatan = Peralatan::find($request->peralatans_id);

        if ($request->hasFile('tools_certificate')) {
            if ($listPeralatan->tools_certificate) {
                Storage::delete($listPeralatan->tools_certificate);
            }
            $file = $request->file('tools_certificate');
            $filename = 'tools_certificate_' . Str::slug($peralatan->nama_peralatan, '_') . '.pdf';
            $filePath = $file->storeAs('public/tools_certificates', $filename);
            $listPeralatan->tools_certificate = $filePath;
        }

        $listPeralatan->update([
            'peralatans_id' => $request->peralatans_id,
            'brand__peralatans_id' => $request->brand__peralatans_id,
            'capacity' => $request->capacity,
            'tahun_beli_peralatans' => $request->tahun_beli_peralatans,
            'ownership' => $request->ownership,
            'certificate_expired_date' => $request->certificate_expired_date,
            'certificate_by' => $request->certificate_by,
            'unit_qty' => $request->unit_qty,
            'status_list_peralatans' => $request->status_list_peralatans,
        ]);

        return redirect()->route('listdataperalatan')->with('success', 'Data peralatan berhasil diperbarui.');
    }

    public function deletelistdataperalatan($id)
    {
        $listPeralatan = List_Peralatan::findOrFail($id);
    
        // Hapus file PDF jika ada
        if ($listPeralatan->tools_certificate) {
            Storage::delete($listPeralatan->tools_certificate);
        }
    
        // Hapus data
        $listPeralatan->delete();
    
        return redirect()->route('listdataperalatan')->with('success', 'Data peralatan berhasil dihapus.');
    }
}

