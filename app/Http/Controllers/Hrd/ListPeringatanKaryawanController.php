<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListPeringatanKaryawanController extends Controller
{
    public function listperingatankaryawan() {
        $data = collect([
            (object) [
                'name' => 'John Doe',
                'divisi_name' => 'IT',
                'cuti_berapakali' => 2,
                'tidak_hadirnya' => 1,
                'jenis_peringatan' => 'Peringatan 1',
                'status_karyawan' => 'Aktif',
                'file_peringatan' => 'peringatan_john_doe.pdf',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            (object) [
                'name' => 'Jane Smith',
                'divisi_name' => 'HR',
                'cuti_berapakali' => 3,
                'tidak_hadirnya' => 2,
                'jenis_peringatan' => 'Peringatan 2',
                'status_karyawan' => 'Aktif',
                'file_peringatan' => 'peringatan_jane_smith.pdf',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(2),
            ],
        ]);

        return view('Hrd.peringatankaryawan.list', compact('data'));
    }
}
