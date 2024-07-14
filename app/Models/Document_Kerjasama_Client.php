<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_Kerjasama_Client extends Model
{
    use HasFactory;

    protected $table = 'document_kerjasama_clients';

    protected $fillable = [
        'user_id',
        'data_sales_id',
        'data_manajer_id',
        'data_direktur_id',
        'data_bank_id',
        'data_legalitas_id',
        'status_kerjasama',
        'keterangan_status_kerjasama',
        'data_kepemilikan_saham',
        'situs_web',
        'email_perusahaan',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan DataSales
    public function dataSales()
    {
        return $this->belongsTo(DataSales::class, 'data_sales_id');
    }
    
    public function dataManajer()
    {
        return $this->belongsTo(DataManajer::class, 'data_manajer_id');
    }
    
    public function dataDirektur()
    {
        return $this->belongsTo(DataDirekturUtama::class, 'data_direktur_id');
    }
    
    public function dataBank()
    {
        return $this->belongsTo(DataBank::class, 'data_bank_id');
    }
    
    public function dataLegalitas()
    {
        return $this->belongsTo(Datalegalitas::class, 'data_legalitas_id');
    }
    
}
