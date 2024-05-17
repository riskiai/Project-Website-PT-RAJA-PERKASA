<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPT extends Model
{
    use HasFactory;
    protected $table = 'kontak_p_t_s';

    protected $fillable = [
        // 'title',
        'email',
        'phone',
        'alamat',
        'link',
        'status_kontak'
    ];
}
