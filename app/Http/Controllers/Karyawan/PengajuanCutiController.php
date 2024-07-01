<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function pengajuancutikaryawan()
    {
        $pengajuan = [
            [
                'user_id' => 'Mamat',
                'role_name' => 'Karyawan',
                'divisi_name' => 'Produksi',
                'alasan_cuti' => 'Cuti tahunan',
                'status_pengajuan_cuti' => 'Disetujui',
                'file_pengajuan_cuti' => 'path/to/file1.pdf'
            ],
            [
                'user_id' => 2,
                'role_name' => 'Karyawan',
                'divisi_name' => 'Quality Control',
                'alasan_cuti' => 'Cuti sakit',
                'status_pengajuan_cuti' => 'Tidak Disetujui',
                'file_pengajuan_cuti' => 'path/to/file2.pdf'
            ]
        ];

        return view('Karyawan.pengajuan_cuti.pengajuancuti', compact('pengajuan'));
    }
}
