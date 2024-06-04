<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_Kerjasama_Client extends Model
{
    use HasFactory;

    protected $table = 'document_kerjasama_clients'; // Specify the table name

    protected $fillable = [
        'user_id',
        'data_sales_id',
        'data_manajer_id',
        'data_direktur_id',
        'data_bank_id',
        'data_legalitas_id',
        'status_kerjasama',
        'keterangan_status_kerjasama',
    ]; // Define the fillable attributes

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataSales()
    {
        return $this->belongsTo(DataSales::class);
    }

    public function dataManajer()
    {
        return $this->belongsTo(DataManajer::class);
    }

    public function dataDirektur()
    {
        return $this->belongsTo(DataDirekturUtama::class);
    }

    public function dataBank()
    {
        return $this->belongsTo(DataBank::class);
    }

    public function dataLegalitas()
    {
        return $this->belongsTo(Datalegalitas::class);
    }
}
