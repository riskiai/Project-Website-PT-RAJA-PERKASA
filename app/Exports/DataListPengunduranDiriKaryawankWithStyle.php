<?php

namespace App\Exports;

use App\Models\Pengundurandiri;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListPengunduranDiriKaryawankWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = Pengundurandiri::with(['user.divisi']);

        // Filter by status_pengunduran_diri
        if (isset($this->filters['status_pengunduran_diri']) && !empty($this->filters['status_pengunduran_diri'])) {
            $query->where('status_pengunduran_diri', $this->filters['status_pengunduran_diri']);
        }

        // Filter by divisi
        if (isset($this->filters['divisi_id']) && !empty($this->filters['divisi_id'])) {
            $query->whereHas('user.divisi', function($q) {
                $q->where('id', $this->filters['divisi_id']);
            });
        }

        $data = $query->get();

        return view('Hrd.reportdata.reportdatapengundurandirikaryawan.export', compact('data'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $sheet->getStyle('A1:H1')->getAlignment()->setVertical('center');
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);

                // Set wrap text for description column
                $sheet->getStyle('A:H')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
