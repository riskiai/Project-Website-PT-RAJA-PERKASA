<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangProyek extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function listProyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'bidangproyek_id');
    }
}
