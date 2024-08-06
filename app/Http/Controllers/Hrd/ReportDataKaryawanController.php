<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Cuti;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use App\Models\Pengundurandiri;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ListPeringatanKaryawan;
use App\Exports\DataListCutiKaryawankWithStyle;
use App\Exports\DataListAbsenKaryawankWithStyle;
use App\Exports\DataListPeringatanKaryawankWithStyle;
use App\Exports\DataListPengunduranDiriKaryawankWithStyle;

class ReportDataKaryawanController extends Controller
{
    /* Report Data Absen Karyawan */
    public function reportlistabsenkaryawan(Request $request) {
        $query = AbsenKaryawan::with('user.divisi');

        // Filter by status_absensi
        if ($request->has('status_absensi') && !empty($request->input('status_absensi'))) {
            $query->where('status_absensi', $request->input('status_absensi'));
        }

        // Filter by divisi
        if ($request->has('divisi_id') && !empty($request->input('divisi_id'))) {
            $query->whereHas('user.divisi', function($q) use ($request) {
                $q->where('id', $request->input('divisi_id'));
            });
        }

        // Filter by bulan_rekap
        if ($request->has('bulan_rekap') && !empty($request->input('bulan_rekap'))) {
            $bulanRekap = date('Y-m', strtotime($request->input('bulan_rekap')));
            $query->whereRaw("DATE_FORMAT(tanggal_absen, '%Y-%m') = ?", [$bulanRekap]);
        }

        $data = $query->get();
        $divisis = Divisi::all();

        return view('Hrd.reportdata.reportdataabsen', compact('data', 'divisis'));
    }

    public function exportreportlistabsenkaryawan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListAbsenKaryawankWithStyle($filters), 'List_Report_Absen.xlsx');
    }

    /* Report Data Pengunduran Diri */
   public function reportlistpengundurandirikaryawan(Request $request) {
    $query = Pengundurandiri::with('user.divisi');

    // Filter by status_pengunduran_diri
    if ($request->has('status_pengunduran_diri') && !empty($request->input('status_pengunduran_diri'))) {
        $query->where('status_pengunduran_diri', $request->input('status_pengunduran_diri'));
    }

    // Filter by divisi
    if ($request->has('divisi_id') && !empty($request->input('divisi_id'))) {
        $query->whereHas('user.divisi', function($q) use ($request) {
            $q->where('id', $request->input('divisi_id'));
        });
    }

    $data = $query->get();
    $divisis = Divisi::all();

    return view('Hrd.reportdata.reportdatapengundurandiri', compact('data', 'divisis'));
    }

    public function exportreportlistpengundurandirikaryawan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListPengunduranDiriKaryawankWithStyle($filters), 'List_Report_PengunduranDiri.xlsx');
    }

    /* Report Data Cuti */
    public function reportlistcutikaryawan(Request $request) {
        $query = Cuti::with('user.divisi');

        // Filter by status_cuti
        if ($request->has('status_cuti') && !empty($request->input('status_cuti'))) {
            $query->where('status_cuti', $request->input('status_cuti'));
        }

        // Filter by divisi
        if ($request->has('divisi_id') && !empty($request->input('divisi_id'))) {
            $query->whereHas('user.divisi', function($q) use ($request) {
                $q->where('id', $request->input('divisi_id'));
            });
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date') && !empty($request->input('start_date')) && !empty($request->input('end_date'))) {
            $query->whereBetween('pengambilan_cuti_tgl', [$request->input('start_date'), $request->input('end_date')]);
        }

        $data = $query->get();
        $divisis = Divisi::all();

        return view('Hrd.reportdata.reporttdatacuti', compact('data', 'divisis'));
    }

    public function exportreportlistcutikaryawan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListCutiKaryawankWithStyle($filters), 'List_Report_Cuti.xlsx');
    }

    /* Report Data List Peringatan Karyawan */
    public function reportlistperingatankaryawan(Request $request) {
        $query = User::with(['absens', 'cutis', 'divisi', 'listPeringatanKaryawans'])
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'karyawan');
            });

        // Filter by jenis_peringatan
        if ($request->has('jenis_peringatan') && !empty($request->input('jenis_peringatan'))) {
            $query->whereHas('listPeringatanKaryawans', function ($q) use ($request) {
                $q->where('jenis_peringatan', $request->input('jenis_peringatan'));
            });
        }

        // Filter by divisi
        if ($request->has('divisi_id') && !empty($request->input('divisi_id'))) {
            $query->whereHas('divisi', function($q) use ($request) {
                $q->where('id', $request->input('divisi_id'));
            });
        }

        // Filter by status_karyawan
        if ($request->has('status_karyawan') && !empty($request->input('status_karyawan'))) {
            $query->where('status_user', $request->input('status_karyawan'));
        }

        $karyawans = $query->get();

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
                'created_at' => $karyawan->listPeringatanKaryawans->last()->created_at ?? null,
            ];
        });

        $divisis = Divisi::all();

        return view('Hrd.reportdata.reportdatalistperingatan', compact('data', 'divisis'));
    }

    public function exportreportlistperingatankaryawan(Request $request) {
        $filters = $request->all();
        return Excel::download(new DataListPeringatanKaryawankWithStyle($filters), 'List_Report_Peringatan.xlsx');
    }
}
