<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'testimonis';

    protected $fillable = [
        'user_id',
        'mitra_id',
        'position',
        'comment',
        'status_testimoni',
        'image',
        'new_user_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }    

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function getNamaClientAttribute()
    {
        return $this->user ? $this->user->name : $this->new_user_name;
    }

    public function getNamaMitraAttribute()
    {
        return $this->mitra ? $this->mitra->name_mitra : null;
    }
}
