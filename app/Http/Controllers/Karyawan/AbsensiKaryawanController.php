<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiKaryawanController extends Controller
{
    public function absenkaryawan()
    {
        $absen = [
            [
                'user_id' => 'Rendi Pangalila',
                'role_name' => 'Karyawan',
                'divisi_name' => 'Produksi',
                'status_absen' => 'Hadir',
                'date_start_absen' => '2024-07-01',
                'date_end_absen' => '2024-07-01',
               'file_muka_absen' => 'path/to/file2.pdf'
            ],
            [
                'user_id' => 2,
                'role_name' => 'Karyawan',
                'divisi_name' => 'Quality Control',
                'status_absen' => 'Sakit',
                'date_start_absen' => '2024-07-02',
                'date_end_absen' => '2024-07-02',
                'file_muka_absen' => 'path/to/file2.pdf'
            ]
        ];

        return view('Karyawan.absen.absenkaryawan', compact('absen'));
    }
}
