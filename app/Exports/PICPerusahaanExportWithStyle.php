<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PICPerusahaanExportWithStyle implements FromView, WithEvents
{
    public function view(): View
    {
        // Ambil data user yang memiliki role 'client' beserta relasinya
        $users = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan')
        ->with(['documentKerjasamaClient', 'mitra'])
        ->get();

        return view('Adminstrator.report.picperusahaan.export', ['users' => $users]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $sheet->getStyle('A1:I1')->getAlignment()->setVertical('center');
                $sheet->getColumnDimension('A')->setWidth(10);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(50);
                $sheet->getColumnDimension('I')->setWidth(50);

                // Set wrap text for description column
                $sheet->getStyle('H:I')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
