<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLegalitas extends Model
{
    use HasFactory;

    protected $table = 'datalegalitas';

    protected $fillable = [
        'no_akta',
        'file_akta',
        'no_siup',
        'file_siup',
        'date_end_siup',
        'no_tdp',
        'file_tdp',
        'date_end_tdp',
        'no_skdp',
        'file_skdp',
        'date_end_skdp',
        'no_iujk',
        'file_iujk',
        'date_end_iujk',
        'file_profile_perusahaan',
        'file_dokumen_kebenaran',
    ];

    // Relasi one-to-many dengan Document_Kerjasama_Client
    public function document_kerjasama()
    {
        return $this->hasMany(Document_Kerjasama_Client::class, 'data_legalitas_id');
    }
}
