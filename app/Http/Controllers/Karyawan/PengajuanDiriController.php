<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanDiriController extends Controller
{
    public function pengajuandirikaryawan()
    {
        $pengajuan = [
            [
                'user_id' => 'Riski',
                'role_name' => 'Karyawan',
                'divisi_name' => 'Produksi',
                'alasan_pengunduran_diri' => 'Pindah ke perusahaan lain',
                'status_pengunduran_diri' => 'Disetujui',
                'file_pengundurandiri' => 'path/to/file1.pdf'
            ],
            [
                'user_id' => 'Arif',
                'role_name' => 'Karyawan',
                'divisi_name' => 'Quality Control',
                'alasan_pengunduran_diri' => 'Masalah Kesehatan',
                'status_pengunduran_diri' => 'Tidak Disetujui',
                'file_pengundurandiri' => 'path/to/file2.pdf'
            ]
        ];

        return view('Karyawan.pengajuan_pengundurandiri.pengajuandiri', compact('pengajuan'));
    }
}
