<?php
// Models/List_Materials.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Materials extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'list__materials';

    public function brand_materials()
    {
        return $this->belongsTo(Brand_Materials::class, 'brand__materials_id');
    }

    public function materials()
    {
        return $this->belongsTo(Materials::class, 'materials_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listProyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'list__materials_id');
    }
}
