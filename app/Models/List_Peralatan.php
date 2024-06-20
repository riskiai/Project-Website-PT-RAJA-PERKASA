<?php

// Models/List_Peralatan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Peralatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'list__peralatans';

    public function brand_peralatan()
    {
        return $this->belongsTo(Brand_Peralatan::class, 'brand__peralatans_id');
    }

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'peralatans_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listProyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'list__peralatans_id');
    }
}
