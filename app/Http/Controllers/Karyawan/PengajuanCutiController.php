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
        $pengajuanTerakhir = Cuti::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

        return view('Karyawan.pengajuan_cuti.pengajuancuti', compact('pengajuan', 'user', 'pengajuanTerakhir'));
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
        $existingCuti = Cuti::where('user_id', $user->id)->first();

        $fileCutiPath = $request->file('file_cuti') ? $request->file('file_cuti')->store('cuti_files', 'public') : ($existingCuti ? $existingCuti->file_cuti : null);

        if ($existingCuti) {
            // Update existing cuti
            $existingCuti->update([
                'alasan_cuti' => $request->alasan_cuti,
                'file_cuti' => $fileCutiPath,
                'lokasi_area_kerja' => $request->lokasi_area_kerja,
                'pengambilan_cuti_tgl' => $request->pengambilan_cuti_tgl,
                'masuk_kembali_tgl' => $request->masuk_kembali_tgl,
            ]);
        } else {
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
        }

        return redirect()->route('pengajuancutikaryawan')->with('success', 'Pengajuan cuti berhasil diajukan.');
    }
}
