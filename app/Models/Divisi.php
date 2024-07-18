<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';

    protected $fillable = [
        'divisi_name'
    ];

    public function users() {
        return $this->hasMany(User::class, 'divisi_id');
    }
}
