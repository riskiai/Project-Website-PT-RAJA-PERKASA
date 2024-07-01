<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting_Apk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'setting__apks';
}
