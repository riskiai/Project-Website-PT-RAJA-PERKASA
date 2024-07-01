<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsenKaryawanController extends Controller
{
    public function listabsenkaryawan() {
        $data = collect([
            (object) [
                'name' => 'John Doe',
                'divisi_name' => 'IT',
                'status_absensi' => 'Hadir',
                'data_start_absen' => '2023-06-01',
                'data_end_absen' => '2023-06-01',
                'file_absen' => 'absen_john_doe.pdf',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'name' => 'Jane Smith',
                'divisi_name' => 'HR',
                'status_absensi' => 'Sakit',
                'data_start_absen' => '2023-06-10',
                'data_end_absen' => '2023-06-12',
                'file_absen' => 'absen_jane_smith.pdf',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(2),
            ],
        ]);

        return view('Hrd.absen.list', compact('data'));
    }
}
