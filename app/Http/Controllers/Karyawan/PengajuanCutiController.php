<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanCutiController extends Controller
{
    public function pengajuancutikaryawan()
    {
        $user = Auth::user();
        $pengajuan = Cuti::where('user_id', $user->id)->get();

        return view('Karyawan.pengajuan_cuti.pengajuancuti', compact('pengajuan', 'user'));
    }

    public function pengajuancutikaryawancreateprosess(Request $request)
    {
        $request->validate([
            'alasan_cuti' => 'required|string',
            'lokasi_area_kerja' => 'required|string',
            'pengambilan_cuti_tgl' => 'required|date',
            'masuk_kembali_tgl' => 'required|date',
            'file_cuti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $fileCutiPath = $request->file('file_cuti') ? $request->file('file_cuti')->store('cuti_files', 'public') : null;

        // Create new cuti
        Cuti::create([
            'user_id' => $user->id,
            'alasan_cuti' => $request->alasan_cuti,
            'status_cuti' => 'belumdicek', // Default status
            'file_cuti' => $fileCutiPath,
            'lokasi_area_kerja' => $request->lokasi_area_kerja,
            'pengambilan_cuti_tgl' => $request->pengambilan_cuti_tgl,
            'masuk_kembali_tgl' => $request->masuk_kembali_tgl,
        ]);

        return redirect()->route('pengajuancutikaryawan')->with('success', 'Pengajuan cuti berhasil diajukan.');
    }

    public function listdatpengajuancutikaryawan()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan data cuti untuk user yang sedang login
        $cutis = Cuti::with('user.divisi')->where('user_id', $user->id)->get();

        // Mengirimkan data ke view listcuti
        return view('Karyawan.pengajuan_cuti.listcuti', compact('cutis'));
    }
}
