<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportDataKaryawanController extends Controller
{
    public function reportlistabsenkaryawan() {

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


        return view('Hrd.reportdata.reportdataabsen',compact('data'));
    }

    public function reportlistpengundurandirikaryawan() {
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

        return view('Hrd.reportdata.reportdatapengundurandiri', compact('data'));
    }

    public function reportlistcutikaryawan() {
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

        return view('Hrd.reportdata.reporttdatacuti', compact('data'));
    }

    public function reportlistperingatankaryawan() {
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

        return view('Hrd.reportdata.reportdatalistperingatan', compact('data'));
    }
}
