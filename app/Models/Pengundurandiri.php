<?php

// App/Models/Pengundurandiri.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengundurandiri extends Model
{
    use HasFactory;

    protected $table = 'pengundurandiris';

    protected $fillable = [
        'user_id',
        'alasan_pengunduran_diri',
        'status_pengunduran_diri',
        'file_pengunduran_diri',
        'file_balasan',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
