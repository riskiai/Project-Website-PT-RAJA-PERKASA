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
            return redirect()->route('picperusahaanlist')->with('error', 'Pengguna tidak ditemukan atau bukan client.');
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

    public function editpicperusahaanproses(Request $request, $id ) {
        $validatedData = $request->validate([
            'status_kerjasama' => 'required|in:ditunggu,diterima,ditolak',
            'keterangan_status_kerjasama' => 'nullable|string|max:255'
        ]);
    
        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $id)->first();
    
        if (!$dataKerjasama) {
            return redirect()->route('picperusahaanlist')->with('error', 'Data kerja sama tidak ditemukan.');
        }
    
        $dataKerjasama->update([
            'status_kerjasama' => $validatedData['status_kerjasama'],
            'keterangan_status_kerjasama' => $validatedData['keterangan_status_kerjasama']
        ]);
    
        // Update the status_pic_perusahaan based on the status_kerjasama
        $user = User::find($dataKerjasama->user_id);
        if ($user) {
            if ($validatedData['status_kerjasama'] == 'diterima') {
                $user->status_pic_perusahaan = 'client';
            } else {
                $user->status_pic_perusahaan = 'calon_client';
            }
            $user->save();
        }
    
        return redirect()->route('picperusahaanlist')->with('success', 'Status kerja sama berhasil diperbarui.');
    }

    public function getKerjasamaData($id) {
        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $id)->first();
        
        if ($dataKerjasama) {
            return response()->json($dataKerjasama);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }
}
