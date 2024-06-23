<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitras';

    protected $fillable = [
        'name_mitra',
        'image',
        'status_mitra'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'mitra_id');
    }
}
