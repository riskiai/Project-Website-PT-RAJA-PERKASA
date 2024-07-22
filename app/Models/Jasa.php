<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasas';

    protected $fillable = [
        // 'title',
        'nama_jasa',
        'short_description',
        'detail_description',
        'status_jasa',
        'image',
    ];
}
