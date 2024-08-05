<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataListKaryawanOwnerkWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = User::with('divisi')
            ->whereHas('role', function($query) {
                $query->where('role_name', 'karyawan');
            });

        if (isset($this->filters['divisi_id']) && !empty($this->filters['divisi_id'])) {
            $query->where('divisi_id', $this->filters['divisi_id']);
        }

        if (isset($this->filters['jk']) && !empty($this->filters['jk'])) {
            $query->where('jk', $this->filters['jk']);
        }

        if (isset($this->filters['status_user']) && !empty($this->filters['status_user'])) {
            $query->where('status_user', $this->filters['status_user']);
        }

        $data = $query->get();

        return view('Owner.reportdata.reportkaryawan.export', compact('data'));
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

                // Set wrap text for description column
                $sheet->getStyle('A:K')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
