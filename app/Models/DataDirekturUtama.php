<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDirekturUtama extends Model
{
    use HasFactory;

    protected $table = 'data_direktur_utamas';

    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'email',
        'jabatan',
    ];

    // Relasi one-to-many dengan Document_Kerjasama_Client
    public function document_kerjasama()
    {
        return $this->hasMany(Document_Kerjasama_Client::class, 'data_direktur_id');
    }
}
