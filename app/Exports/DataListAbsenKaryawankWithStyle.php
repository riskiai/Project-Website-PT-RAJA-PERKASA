<?php

namespace App\Exports;

use App\Models\AbsenKaryawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListAbsenKaryawankWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = AbsenKaryawan::with(['user.divisi']);

        // Filter by status_absensi
        if (isset($this->filters['status_absensi']) && !empty($this->filters['status_absensi'])) {
            $query->where('status_absensi', $this->filters['status_absensi']);
        }

        // Filter by divisi
        if (isset($this->filters['divisi_id']) && !empty($this->filters['divisi_id'])) {
            $query->whereHas('user.divisi', function($q) {
                $q->where('id', $this->filters['divisi_id']);
            });
        }

        // Filter by bulan_rekap
        if (isset($this->filters['bulan_rekap']) && !empty($this->filters['bulan_rekap'])) {
            $bulanRekap = date('Y-m', strtotime($this->filters['bulan_rekap']));
            $query->whereRaw("DATE_FORMAT(tanggal_absen, '%Y-%m') = ?", [$bulanRekap]);
        }

        $data = $query->get();

        return view('Hrd.reportdata.reportdataabsenkaryawan.export', compact('data'));
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
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);

                // Set wrap text for description column
                $sheet->getStyle('A:I')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
