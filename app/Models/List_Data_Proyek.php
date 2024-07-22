<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Data_Proyek extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'list__data__proyeks';

    protected $fillable = [
        'user_id', 'bidangproyek_id', 'materials_id', 'brand__materials_id', 'peralatans_id', 
        'brand__peralatans_id', 'title_proyek', 'project_name', 'client_name', 
        'main_contractor', 'scope', 'start_date_proyek', 'end_date_proyek', 
        'value', 'po', 'handover', 'image', 'status_progres_proyek', 
        'status_proyek', 'keterangan_status_proyek'
    ];

    protected $casts = [
        'image' => 'array', // Cast image as an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bidangproyeks()
    {
        return $this->belongsTo(BidangProyek::class, 'bidangproyek_id');
    }

    public function materials()
    {
        return $this->belongsTo(Materials::class, 'materials_id');
    }

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'peralatans_id');
    }

    public function brandMaterials()
    {
        return $this->belongsTo(Brand_Materials::class, 'brand__materials_id');
    }

    public function brandPeralatan()
    {
        return $this->belongsTo(Brand_Peralatan::class, 'brand__peralatans_id');
    }
}
