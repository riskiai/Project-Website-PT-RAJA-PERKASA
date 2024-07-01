<?php

namespace App\Exports;

use App\Models\List_Peralatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListPeralatankWithStyle implements FromView, WithEvents
{
    public function view(): View
    {
        // Ambil data peralatan beserta relasinya
        $data = List_Peralatan::with([
            'peralatan',
            'brand_peralatan'
        ])->get();

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
