<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataManajer extends Model
{
    use HasFactory;

    protected $table = 'data_manajers'; // Specify the table name

    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'email',
        'jabatan',
    ]; // Define the fillable attributes

     // untuk relasi one To Many
     public function document_kerjasama() {
        return $this->hasMany(Document_Kerjasama_Client::class);
    }
}
