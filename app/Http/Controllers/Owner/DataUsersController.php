<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Document_Kerjasama_Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataUsersController extends Controller
{
    public function ownerkaryawanlist() {
        $data = User::with('divisi')
        ->whereHas('role', function($query) {
            $query->where('role_name', 'karyawan');
        })
        ->get();

    return view('Owner.users.listdatakaryawan', compact('data'));
    }

    public function ownershowkaryawanlist($id) {
        $user = User::findOrFail($id);
        $divisi = Divisi::all();

        return view('Owner.users.showlistdatakaryawan', compact('user', 'divisi'));
    }

    public function picperusahaanlist() {
        $data = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan')
        ->with(['documentKerjasamaClient', 'mitra'])
        ->get();
        
        return view('Owner.users.listdatapicexternal', compact('data'));
    }

    public function ownershowpicperusahaanlist($id) {
        $user = User::with('role')->find($id);
    
        if (!$user || $user->role->role_name != 'client') {
            return redirect()->route('userslisteclient')->with('error', 'Pengguna tidak ditemukan atau bukan client.');
        }
    
        $dataKerjasama = Document_Kerjasama_Client::with([
            'dataSales',
            'dataManajer',
            'dataDirektur',
            'dataBank',
            'dataLegalitas'
        ])->where('user_id', $id)->first();
    
        return view('Owner.users.showlistpicexternal', compact('user', 'dataKerjasama'));
    }
}
