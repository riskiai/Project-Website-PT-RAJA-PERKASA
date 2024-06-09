<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\User;
use App\Models\Document_Kerjasama_Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.users.internal_ptrajaperkasa.list');
    }

    public function getclient() {
        // Ambil data pengguna dengan role 'client' saja
        $data = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user')->get();

        return view('Adminstrator.users.client_external.list', compact('data'));
    }

    public function showclient($id) {
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
    
        return view('Adminstrator.users.client_external.show', compact('user', 'dataKerjasama'));
    }
    

    public function editclient($id) {
        $dataKerjasama = Document_Kerjasama_Client::with(['dataSales', 'dataManajer', 'dataDirektur', 'dataBank', 'dataLegalitas'])
                            ->where('user_id', $id)->first();

        if (!$dataKerjasama) {
            return redirect()->route('userslisteclient')->with('error', 'Data kerja sama tidak ditemukan.');
        }

        return view('Adminstrator.users.client_external.edit', compact('dataKerjasama'));
    }

    public function editclientproses(Request $request, $id) {
        $validatedData = $request->validate([
            'status_kerjasama' => 'required|in:ditunggu,diterima,ditolak',
            'keterangan_status_kerjasama' => 'nullable|string|max:255'
        ]);

        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $id)->first();

        if (!$dataKerjasama) {
            return redirect()->route('userslisteclient')->with('error', 'Data kerja sama tidak ditemukan.');
        }

        $dataKerjasama->update([
            'status_kerjasama' => $validatedData['status_kerjasama'],
            'keterangan_status_kerjasama' => $validatedData['keterangan_status_kerjasama']
        ]);

        return redirect()->route('userslisteclient')->with('success', 'Status kerja sama berhasil diperbarui.');
    }
}
