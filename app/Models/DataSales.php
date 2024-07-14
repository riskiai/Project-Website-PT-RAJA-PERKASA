<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSales extends Model
{
    use HasFactory;

    protected $table = 'data_sales';

    protected $fillable = [
        'name_lengkap',
        'no_hp',
        'email',
        'jabatan',
    ];

    // Relasi one-to-many dengan Document_Kerjasama_Client
    public function document_kerjasama()
    {
        return $this->hasMany(Document_Kerjasama_Client::class, 'data_sales_id');
    }
}
