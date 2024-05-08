<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangPT extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'tentangptrajapekasa';
    
    
    /* 
        protected $fillable = [
            'id',
            'title',
            'short_description',
            'detail_description',
            'status_user',
            'image'
        ]; 
    */
}
