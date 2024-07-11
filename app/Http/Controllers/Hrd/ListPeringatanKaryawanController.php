<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ListPeringatanKaryawan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListPeringatanKaryawanController extends Controller
{
    public function listperingatankaryawan()
    {
        $karyawans = User::with(['absens', 'cutis', 'divisi'])
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'karyawan');
            })
            ->get();

        $data = $karyawans->map(function ($karyawan) {
            $tidakHadirCount = $karyawan->absens->where('status_absensi', 'tidak_hadir')->count();
            $cutiCount = $karyawan->cutis->count();

            $jenisPeringatan = null;
            if ($tidakHadirCount >= 3 && $cutiCount >= 3) {
                $jenisPeringatan = 'peringatan_pemberhentian';
            } elseif ($tidakHadirCount >= 2 && $cutiCount >= 2) {
                $jenisPeringatan = 'peringatan_pemanggilan';
            } elseif ($tidakHadirCount >= 1 && $cutiCount >= 1) {
                $jenisPeringatan = 'peringatan_peneguran';
            }

            return (object) [
                'user_id' => $karyawan->id,
                'name' => $karyawan->name,
                'divisi_name' => $karyawan->divisi->divisi_name,
                'cuti_berapakali' => $cutiCount,
                'tidak_hadirnya' => $tidakHadirCount,
                'jenis_peringatan' => $jenisPeringatan,
                'status_karyawan' => $karyawan->status_user,
                'file_peringatan' => $karyawan->listPeringatanKaryawans->last()->file_peringatan ?? null,
            ];
        });

        return view('Hrd.peringatankaryawan.list', compact('data'));
    }

    public function updateperingatankaryawan(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $peringatan = new ListPeringatanKaryawan();
        $peringatan->user_id = $karyawan->id;
        $peringatan->jenis_peringatan = $request->jenis_peringatan;
        $peringatan->status_karyawan = $request->status_karyawan;

        if ($request->hasFile('file_peringatan')) {
            $file = $request->file('file_peringatan');
            $fileName = sprintf('%s_%s_%s.pdf',
                $request->jenis_peringatan,
                Str::slug($karyawan->name),
                Str::slug($karyawan->divisi->divisi_name)
            );
            $filePath = $file->storeAs('public/peringatan', $fileName);
            $peringatan->file_peringatan = str_replace('public/', '', $filePath);
        }

        $peringatan->save();

        return redirect()->route('listperingatankaryawan')->with('success', 'Peringatan karyawan berhasil diperbarui.');
    }
}
