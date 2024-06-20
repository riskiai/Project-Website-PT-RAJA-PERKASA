<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function list_peralatans()
    {
        return $this->hasMany(List_Peralatan::class, 'peralatans_id');
    }

    public function listProyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'peralatans_id');
    }
}
