<?php

namespace App\Http\Controllers\Hrd;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsenKaryawanController extends Controller
{
    public function listabsenkaryawan() {
        $this->updateStatusTidakHadir(); // Panggil metode untuk memperbarui status tidak hadir

        $absens = AbsenKaryawan::whereDate('tanggal_absen', Carbon::today())->get();

        return view('Hrd.absen.list', compact('absens'));
    }

    private function updateStatusTidakHadir()
    {
        $absens = AbsenKaryawan::whereNull('waktu_pulang_kehadiran')
            ->where('tanggal_absen', '<', Carbon::now()->subDay())
            ->get();

        foreach ($absens as $absen) {
            $absen->update(['status_absensi' => 'tidak_hadir']);
        }
    }
}
