<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'divisi_id',
        'mitra_id',
        'name',
        'email',
        'nik',
        'password',
        'no_hp',
        'alamat',
        'tgl_lahir',
        'jk',
        'file_ktp',
        'status_user',
        'status_pic_perusahaan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tgl_lahir' => 'date',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function documentKerjasamaClient()
    {
        return $this->hasOne(Document_Kerjasama_Client::class, 'user_id');
    }

    public function listPeralatan()
    {
        return $this->hasMany(List_Peralatan::class, 'user_id');
    }

    public function listMaterials()
    {
        return $this->hasMany(List_Materials::class, 'user_id');
    }

    public function listproyek()
    {
        return $this->hasMany(List_Data_Proyek::class, 'user_id');
    }

    public function pengundurandiri()
    {
        return $this->hasMany(Pengundurandiri::class, 'user_id');
    }

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'user_id');
    }

    public function absens()
    {
        return $this->hasMany(AbsenKaryawan::class, 'user_id');
    }

    public function listPeringatanKaryawans()
    {
        return $this->hasMany(ListPeringatanKaryawan::class, 'user_id');
    }

    public function getRoleNameAttribute()
    {
        $document = $this->documentKerjasamaClient;
        if ($document && $document->status_kerjasama == 'diterima') {
            return $this->status_pic_perusahaan;
        }
        return 'calon_client';
    }
}
