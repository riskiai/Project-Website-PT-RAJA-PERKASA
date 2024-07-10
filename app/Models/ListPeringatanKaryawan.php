<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPeringatanKaryawan extends Model
{
    use HasFactory;

    protected $table = 'list_peringatan_karyawans';

    protected $fillable = [
        'user_id',
        'cuti_id',
        'absen_id',
        'jenis_peringatan',
        'status_karyawan',
        'file_peringatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cuti()
    {
        return $this->belongsTo(Cuti::class);
    }

    public function absen()
    {
        return $this->belongsTo(AbsenKaryawan::class);
    }
}
