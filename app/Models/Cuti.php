<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cutis';

    protected $fillable = [
        'user_id',
        'alasan_cuti',
        'status_cuti',
        'file_cuti',
        'file_balasan',
        'lokasi_area_kerja',
        'pengambilan_cuti_tgl',
        'masuk_kembali_tgl',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
