<?php

namespace App\Exports;

use App\Models\Cuti;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListCutiKaryawankWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = Cuti::with(['user.divisi']);

        // Filter by status_cuti
        if (isset($this->filters['status_cuti']) && !empty($this->filters['status_cuti'])) {
            $query->where('status_cuti', $this->filters['status_cuti']);
        }

        // Filter by divisi
        if (isset($this->filters['divisi_id']) && !empty($this->filters['divisi_id'])) {
            $query->whereHas('user.divisi', function($q) {
                $q->where('id', $this->filters['divisi_id']);
            });
        }

        // Filter by date range
        if (isset($this->filters['start_date']) && isset($this->filters['end_date']) && !empty($this->filters['start_date']) && !empty($this->filters['end_date'])) {
            $query->whereBetween('pengambilan_cuti_tgl', [$this->filters['start_date'], $this->filters['end_date']]);
        }

        $data = $query->get();

        return view('Hrd.reportdata.reportdatacutikaryawan.export', compact('data'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $sheet->getStyle('A1:J1')->getAlignment()->setVertical('center');
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(20);

                // Set wrap text for description column
                $sheet->getStyle('A:J')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
