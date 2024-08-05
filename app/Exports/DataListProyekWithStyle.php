<?php

namespace App\Exports;

use App\Models\List_Data_Proyek;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListProyekWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = List_Data_Proyek::with([
            'materials',
            'brandMaterials',
            'peralatan',
            'brandPeralatan'
        ]);

        if (isset($this->filters['updated_at']) && !empty($this->filters['updated_at'])) {
            $query->whereDate('updated_at', date('Y-m-d', strtotime($this->filters['updated_at'])));
        }

        if (isset($this->filters['bidangproyek_id']) && !empty($this->filters['bidangproyek_id'])) {
            $query->where('bidangproyek_id', $this->filters['bidangproyek_id']);
        }

        if (isset($this->filters['status_progres_proyek']) && !empty($this->filters['status_progres_proyek'])) {
            $query->where('status_progres_proyek', $this->filters['status_progres_proyek']);
        }

        if (isset($this->filters['status_proyek']) && !empty($this->filters['status_proyek'])) {
            $query->where('status_proyek', $this->filters['status_proyek']);
        }

        $proyeks = $query->get();


        return view('Manajer.report.dataproyeks.export', ['proyeks' => $proyeks]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $sheet->getStyle('A1:K1')->getAlignment()->setVertical('center');
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(15);
                $sheet->getColumnDimension('K')->setWidth(20);
                $sheet->getColumnDimension('L')->setWidth(15);

                // Set wrap text for description column
                $sheet->getStyle('A:K')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
