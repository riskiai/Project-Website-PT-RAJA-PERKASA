<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengundurandiri;
use Illuminate\Support\Facades\Auth;

class PengajuanDiriController extends Controller
{
    public function pengajuandirikaryawan()
    {
        $user = Auth::user();

        // Mengambil data pengunduran terakhir berdasarkan user_id
        $pengunduranTerakhir = Pengundurandiri::where('user_id', $user->id)->latest()->first();

        return view('Karyawan.pengajuan_pengundurandiri.pengajuandiri', compact('user', 'pengunduranTerakhir'));
    }

    public function pengajuandirikaryawancreateprosess(Request $request)
    {
        $request->validate([
            'alasan_pengunduran_diri' => 'required|string',
            'file_pengundurandiri' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $filePath = $request->file('file_pengundurandiri')->store('pengundurandiri_files', 'public');

        Pengundurandiri::create([
            'user_id' => Auth::id(),
            'alasan_pengunduran_diri' => $request->alasan_pengunduran_diri,
            'status_pengunduran_diri' => 'belumdicek',
            'file_pengunduran_diri' => $filePath
        ]);

        return redirect()->route('pengajuandirikaryawan')->with('success', 'Pengajuan pengunduran diri berhasil dikirim.');
    }
}
