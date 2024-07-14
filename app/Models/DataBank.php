<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBank extends Model
{
    use HasFactory;

    protected $table = 'data_banks';

    protected $fillable = [
        'nama_pemilik_rekening',
        'no_rekening',
        'nama_bank',
        'cabang_bank',
        'alamat_bank',
    ];

    // Relasi one-to-many dengan Document_Kerjasama_Client
    public function document_kerjasama()
    {
        return $this->hasMany(Document_Kerjasama_Client::class, 'data_bank_id');
    }
}
