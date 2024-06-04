<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBank extends Model
{
    use HasFactory;

    protected $table = 'data_banks'; // Specify the table name

    protected $fillable = [
        'nama_pemilik_rekening',
        'no_rekening',
        'nama_bank',
        'cabang_bank',
        'alamat_bank',
    ]; // Define the fillable attributes

     // untuk relasi one To Many
     public function document_kerjasama() {
        return $this->hasMany(Document_Kerjasama_Client::class);
    }
}
