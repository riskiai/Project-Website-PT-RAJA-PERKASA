<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangProyek extends Model
{
    use HasFactory;

    protected $table = 'bidang_proyeks';

    protected $fillable = [
        'nama_bidang_pekerjaan_proyek',
        'status_bidang_pekerjaan_proyek'
    ];

    public function listProyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'bidangproyek_id');
    }
}
