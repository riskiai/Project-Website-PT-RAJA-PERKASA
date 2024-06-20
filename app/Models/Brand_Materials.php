<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand_Materials extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function list_materials()
    {
        return $this->hasMany(List_Materials::class, 'brand__materials_id');
    }

    public function listProyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'brand__materials_id');
    }
}
