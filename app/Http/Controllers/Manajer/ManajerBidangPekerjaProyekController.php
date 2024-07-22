<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\BidangProyek;
use Illuminate\Http\Request;

class ManajerBidangPekerjaProyekController extends Controller
{
    public function index()
    {
        $data = BidangProyek::all();
        return view('Manajer.bidangpekerjaanproyek.list', compact('data'));
    }

    public function create()
    {
        return view('Manajer.bidangpekerjaanproyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang_pekerjaan_proyek' => 'required|string|max:255',
            'status_bidang_pekerjaan_proyek' => 'required|in:active,nonactive',
        ]);

        BidangProyek::create([
            'nama_bidang_pekerjaan_proyek' => $request->nama_bidang_pekerjaan_proyek,
            'status_bidang_pekerjaan_proyek' => $request->status_bidang_pekerjaan_proyek,
        ]);

        return redirect()->route('bidangpekerjaanproyek.list')->with('success', 'Data Bidang Pekerjaan Proyek berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bidangProyek = BidangProyek::findOrFail($id);
        return view('Manajer.bidangpekerjaanproyek.edit', compact('bidangProyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang_pekerjaan_proyek' => 'required|string|max:255',
            'status_bidang_pekerjaan_proyek' => 'required|in:active,nonactive',
        ]);

        $bidangProyek = BidangProyek::findOrFail($id);
        $bidangProyek->update([
            'nama_bidang_pekerjaan_proyek' => $request->nama_bidang_pekerjaan_proyek,
            'status_bidang_pekerjaan_proyek' => $request->status_bidang_pekerjaan_proyek,
        ]);

        return redirect()->route('bidangpekerjaanproyek.list')->with('success', 'Data Bidang Pekerjaan Proyek berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bidangProyek = BidangProyek::findOrFail($id);
        $bidangProyek->delete();

        return redirect()->route('bidangpekerjaanproyek.list')->with('success', 'Data Bidang Pekerjaan Proyek berhasil dihapus.');
    }
}
