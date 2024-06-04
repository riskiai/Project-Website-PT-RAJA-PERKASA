<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSales extends Model
{
    use HasFactory;

    protected $table = 'data_sales'; // Specify the table name

    protected $fillable = [
        'name_lengkap',
        'no_hp',
        'email',
        'jabatan',
    ]; 

    // untuk relasi one To Many
    public function document_kerjasama() {
        return $this->hasMany(Document_Kerjasama_Client::class);
    }
}
