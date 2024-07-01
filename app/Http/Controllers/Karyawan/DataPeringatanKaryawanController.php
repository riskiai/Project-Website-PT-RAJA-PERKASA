<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPeringatanKaryawanController extends Controller
{
    public function peringatankaryawan()
    {
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
        ]);

        return view('Karyawan.peringatan_karyawan.listperingatankaryawan', compact('data'));
    }
}
