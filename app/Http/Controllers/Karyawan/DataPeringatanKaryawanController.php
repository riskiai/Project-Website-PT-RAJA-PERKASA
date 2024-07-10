<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ListPeringatanKaryawan;
use Illuminate\Support\Facades\Auth;

class DataPeringatanKaryawanController extends Controller
{
    public function peringatankaryawan()
    {
        $user_id = Auth::id();
        $data = ListPeringatanKaryawan::where('user_id', $user_id)
            ->with('user', 'user.divisi')
            ->get()
            ->map(function ($peringatan) {
                return (object) [
                    'name' => $peringatan->user->name,
                    'divisi_name' => $peringatan->user->divisi->divisi_name,
                    'cuti_berapakali' => $peringatan->user->cutis->count(),
                    'tidak_hadirnya' => $peringatan->user->absens->where('status_absensi', 'tidak_hadir')->count(),
                    'jenis_peringatan' => $peringatan->jenis_peringatan,
                    'status_karyawan' => $peringatan->status_karyawan,
                    'file_peringatan' => $peringatan->file_peringatan,
                    // 'created_at' => $peringatan->created_at,
                    // 'updated_at' => $peringatan->updated_at,
                ];
            });

        return view('Karyawan.peringatan_karyawan.listperingatankaryawan', compact('data'));
    }
}
