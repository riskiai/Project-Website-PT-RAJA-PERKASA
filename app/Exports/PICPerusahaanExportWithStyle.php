<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PICPerusahaanExportWithStyle implements FromView, WithEvents
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan', 'created_at')
        ->with(['documentKerjasamaClient', 'mitra']);

        // Apply filters
        if (isset($this->filters['created_at_start']) && !empty($this->filters['created_at_start']) &&
            isset($this->filters['created_at_end']) && !empty($this->filters['created_at_end'])) {
            $startDate = date('Y-m-d', strtotime($this->filters['created_at_start']));
            $endDate = date('Y-m-d', strtotime($this->filters['created_at_end']));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (isset($this->filters['status_pic_perusahaan']) && !empty($this->filters['status_pic_perusahaan'])) {
            $query->where('status_pic_perusahaan', $this->filters['status_pic_perusahaan']);
        }

        if (isset($this->filters['status_kerjasama']) && !empty($this->filters['status_kerjasama'])) {
            $query->whereHas('documentKerjasamaClient', function($q) {
                $q->where('status_kerjasama', $this->filters['status_kerjasama']);
            });
        }

        $users = $query->get();

        return view('Adminstrator.report.picperusahaan.export', ['users' => $users]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getStyle('A1:J1')->getAlignment()->setVertical('center'); // Ubah dari A1:I1 ke A1:J1
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(50);
                $sheet->getColumnDimension('I')->setWidth(50);
                $sheet->getColumnDimension('J')->setWidth(20); // Tambahkan untuk kolom created_at

                $sheet->getStyle('H:I')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
