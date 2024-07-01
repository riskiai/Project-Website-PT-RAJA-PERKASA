<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengunduranDiriKaryawanController extends Controller
{
    /* Data List Pengajuan Pengunduran Diri */
    public function listpengundurandirikaryawan() {
        $data = collect([
            (object) [
                'name' => 'John Doe',
                'divisi_name' => 'IT',
                'alasan' => 'Pindah ke perusahaan lain',
                'status' => 'Disetujui',
                'file' => 'resignation_john_doe.pdf',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'name' => 'Jane Smith',
                'divisi_name' => 'HR',
                'alasan' => 'Melanjutkan pendidikan',
                'status' => 'Tidak Disetujui',
                'file' => 'resignation_jane_smith.pdf',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(2),
            ],
        ]);

        return view('Hrd.pengundurandiri.list', compact('data'));
    }
}
