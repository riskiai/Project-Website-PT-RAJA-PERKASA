<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListPeringatanKaryawankWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = User::with(['absens', 'cutis', 'divisi', 'listPeringatanKaryawans'])
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'karyawan');
            });

        // Filter by jenis_peringatan
        if (isset($this->filters['jenis_peringatan']) && !empty($this->filters['jenis_peringatan'])) {
            $query->whereHas('listPeringatanKaryawans', function ($q) {
                $q->where('jenis_peringatan', $this->filters['jenis_peringatan']);
            });
        }

        // Filter by divisi
        if (isset($this->filters['divisi_id']) && !empty($this->filters['divisi_id'])) {
            $query->whereHas('divisi', function($q) {
                $q->where('id', $this->filters['divisi_id']);
            });
        }

        // Filter by status_karyawan
        if (isset($this->filters['status_karyawan']) && !empty($this->filters['status_karyawan'])) {
            $query->where('status_user', $this->filters['status_karyawan']);
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

        return view('Hrd.reportdata.reportdataperingatankaryawan.export', compact('data'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $sheet->getStyle('A1:I1')->getAlignment()->setVertical('center');
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);

                // Set wrap text for description column
                $sheet->getStyle('A:I')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
