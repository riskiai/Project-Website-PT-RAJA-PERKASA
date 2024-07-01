<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CutiKaryawanController extends Controller
{
    /* Data Cuti Karyawan */
    public function listcutikaryawan() {
        $data = collect([
            (object) [
                'name' => 'John Doe',
                'divisi_name' => 'IT',
                'alasan' => 'Sakit',
                'status' => 'Disetujui',
                'file' => 'cuti_john_doe.pdf',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'name' => 'Jane Smith',
                'divisi_name' => 'HR',
                'alasan' => 'Liburan',
                'status' => 'Tidak Disetujui',
                'file' => 'cuti_jane_smith.pdf',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(2),
            ],
        ]);

        return view('Hrd.cuti.list', compact('data'));
    }
}
