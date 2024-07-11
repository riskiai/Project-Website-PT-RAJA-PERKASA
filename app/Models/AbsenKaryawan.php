<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenKaryawan extends Model
{
    use HasFactory;

    protected $table = 'absen_karyawans';

    protected $fillable = [
        'user_id',
        'tanggal_absen',
        'status_absensi',
        'bukti_kehadiran',
        'surat_izin_sakit',
        'waktu_datang_kehadiran',
        'waktu_pulang_kehadiran',
    ];

    protected $attributes = [
        'status_absensi' => 'tidak_hadir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
