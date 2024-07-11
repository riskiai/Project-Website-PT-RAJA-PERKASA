<?php

namespace App\Http\Controllers\Hrd;

use App\Exports\DataListAbsenKaryawankWithStyle;
use App\Exports\DataListCutiKaryawankWithStyle;
use App\Exports\DataListPengunduranDiriKaryawankWithStyle;
use App\Exports\DataListPeringatanKaryawankWithStyle;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use App\Models\Pengundurandiri;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ListPeringatanKaryawan;

class ReportDataKaryawanController extends Controller
{

    /* Report Data Absen Karyawan */
    public function reportlistabsenkaryawan() {
        $data = AbsenKaryawan::with('user.divisi')->get();

        return view('Hrd.reportdata.reportdataabsen', compact('data'));
    }

    public function exportreportlistabsenkaryawan() {
        return Excel::download(new DataListAbsenKaryawankWithStyle(), 'List_Report_Absen.xlsx');
    }

    /* Report Data Pengunduran Diri */
    public function reportlistpengundurandirikaryawan() {
        $data = Pengundurandiri::with('user.divisi')->get();

        return view('Hrd.reportdata.reportdatapengundurandiri', compact('data'));
    }

    public function exportreportlistpengundurandirikaryawan() {
        return Excel::download(new DataListPengunduranDiriKaryawankWithStyle(), 'List_Report_PengunduranDiri.xlsx');
    }

    /* Report Data Report Cuti */
    public function reportlistcutikaryawan() {
        $data = Cuti::with('user.divisi')->get();

        return view('Hrd.reportdata.reporttdatacuti', compact('data'));
    }

    public function exportreportlistcutikaryawan() {
        return Excel::download(new DataListCutiKaryawankWithStyle(), 'List_Report_Cuti.xlsx');
    }

    /* Report Data List Peringatan Karyawan */
    public function reportlistperingatankaryawan() {
        $karyawans = User::with(['absens', 'cutis', 'divisi', 'listPeringatanKaryawans'])
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'karyawan');
            })
            ->get();

        $data = $karyawans->map(function ($karyawan) {
            $tidakHadirCount = $karyawan->absens ? $karyawan->absens->where('status_absensi', 'tidak_hadir')->count() : 0;
            $cutiCount = $karyawan->cutis ? $karyawan->cutis->count() : 0;

            $jenisPeringatan = null;
            if ($tidakHadirCount >= 3 && $cutiCount >= 3) {
                $jenisPeringatan = 'peringatan_pemberhentian';
            } elseif ($tidakHadirCount >= 2 && $cutiCount >= 2) {
                $jenisPeringatan = 'peringatan_pemanggilan';
            } elseif ($tidakHadirCount >= 1 && $cutiCount >= 1) {
                $jenisPeringatan = 'peringatan_peneguran';
            }

            return (object) [
                'user_id' => $karyawan->id,
                'name' => $karyawan->name,
                'divisi_name' => $karyawan->divisi->divisi_name ?? 'N/A',
                'cuti_berapakali' => $cutiCount,
                'tidak_hadirnya' => $tidakHadirCount,
                'jenis_peringatan' => $jenisPeringatan,
                'status_karyawan' => $karyawan->status_user,
                'file_peringatan' => $karyawan->listPeringatanKaryawans->last()->file_peringatan ?? null,
            ];
        });

        return view('Hrd.reportdata.reportdatalistperingatan', compact('data'));
    }

    public function exportreportlistperingatankaryawan() {
        return Excel::download(new DataListPeringatanKaryawankWithStyle(), 'List_Report_Peringatan.xlsx');
    }
}
