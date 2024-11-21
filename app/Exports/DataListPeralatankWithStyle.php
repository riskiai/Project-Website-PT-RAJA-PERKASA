<?php

namespace App\Exports;

use App\Models\List_Peralatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListPeralatankWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = List_Peralatan::with([
            'peralatan',
            'brand_peralatan'
        ]);

        // Filter by created_at range
        if (isset($this->filters['created_at_start']) && !empty($this->filters['created_at_start']) &&
            isset($this->filters['created_at_end']) && !empty($this->filters['created_at_end'])) {
            $startDate = date('Y-m-d', strtotime($this->filters['created_at_start']));
            $endDate = date('Y-m-d', strtotime($this->filters['created_at_end']));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filter by brand peralatan
        if (isset($this->filters['brand_peralatan_id']) && !empty($this->filters['brand_peralatan_id'])) {
            $query->where('brand__peralatans_id', $this->filters['brand_peralatan_id']);
        }

        // Filter by tahun beli peralatan
        // if (isset($this->filters['tahun_beli_peralatans']) && !empty($this->filters['tahun_beli_peralatans'])) {
        //     $query->whereYear('tahun_beli_peralatans', $this->filters['tahun_beli_peralatans']);
        // }

        $data = $query->get();

        return view('Manajer.report.dataperalatan.export', ['data' => $data]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $sheet->getStyle('A1:H1')->getAlignment()->setVertical('center');
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('B')->setWidth(10);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(10);
                $sheet->getColumnDimension('F')->setWidth(30);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(15);

                // Set wrap text for description column
                $sheet->getStyle('A:H')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
