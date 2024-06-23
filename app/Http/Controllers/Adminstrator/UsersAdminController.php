<?php

namespace App\Http\Controllers\Adminstrator;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Document_Kerjasama_Client;

class UsersAdminController extends Controller
{
    /* Profile */
    public function editProfile($id) {
        $user = User::findOrFail($id);
        $user->tgl_lahir_formatted = $user->tgl_lahir ? Carbon::parse($user->tgl_lahir)->translatedFormat('F, d Y') : null;
        $user->alamat_stripped = strip_tags($user->alamat);
        return view('Adminstrator.users.profile', compact('user'));
    }
    
    public function updateprofile(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jk' => 'required|in:L,P',
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->no_hp = $validatedData['no_hp'];
        $user->alamat = $validatedData['alamat'];
        $user->tgl_lahir = $validatedData['tgl_lahir'] ?? $user->tgl_lahir;
        $user->jk = $validatedData['jk'];
    
        if ($request->hasFile('file_foto')) {
            if ($user->file_foto) {
                Storage::delete('public/client/photo-profile/' . $user->file_foto);
            }
    
            $fileFoto = $request->file('file_foto');
            $fileNameFoto = time() . '_' . $fileFoto->getClientOriginalName();
            $fileFoto->storeAs('public/client/photo-profile', $fileNameFoto);
            $user->file_foto = $fileNameFoto;
        }
    
        $user->save();
    
        return redirect()->route('editusersprofile', $user->id)->with('success', 'Profile berhasil diperbarui.');
    }
    

    /* Users Internal PT Raja Perkasa */
    public function index() {
        $data = User::with(['divisi', 'role'])
                    ->whereHas('role', function($query) {
                        $query->where('role_name', '!=', 'client');
                    })
                    ->get();
        return view('Adminstrator.users.internal_ptrajaperkasa.list', compact('data'));
    }
    

    public function create() {
        $divisis = Divisi::all();
        $roles = Role::where('role_name', '!=', 'client')->get();
        return view('Adminstrator.users.internal_ptrajaperkasa.create', compact('divisis', 'roles'));
    }
    

    public function createproses(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jk' => 'required|in:L,P',
            'divisi_id' => 'required|exists:divisis,id',
            'role_id' => 'required|exists:roles,id',
            'status_user' => 'required|in:active,nonactive',
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->nik = $validatedData['nik'];
        $user->password = bcrypt($validatedData['password']);
        $user->no_hp = $validatedData['no_hp'];
        $user->alamat = $validatedData['alamat'];
        $user->tgl_lahir = $validatedData['tgl_lahir'];
        $user->jk = $validatedData['jk'];
        $user->divisi_id = $validatedData['divisi_id'];
        $user->role_id = $validatedData['role_id'];
        $user->status_user = $validatedData['status_user'];
    
        if ($request->hasFile('file_foto')) {
            $fileFoto = $request->file('file_foto');
            $fileNameFoto = time() . '_' . $fileFoto->getClientOriginalName();
            $fileFoto->storeAs('public/client/photo-profile', $fileNameFoto);
            $user->file_foto = $fileNameFoto;
        }
    
        if ($request->hasFile('file_ktp')) {
            $fileKtp = $request->file('file_ktp');
            $fileNameKtp = time() . '_' . $fileKtp->getClientOriginalName();
            $fileKtp->storeAs('public/client/file_ktp', $fileNameKtp);
            $user->file_ktp = $fileNameKtp;
        }
    
        $user->save();
    
        return redirect()->route('userslist')->with('success', 'User berhasil ditambahkan.');
    }

    public function showpegawai($id) {
        $user = User::with(['divisi', 'role'])->find($id);
    
        if (!$user) {
            return redirect()->route('userslist')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Format tanggal lahir
        $user->tgl_lahir_formatted = Carbon::parse($user->tgl_lahir)->translatedFormat('d F Y');
    
        return view('Adminstrator.users.internal_ptrajaperkasa.show', compact('user'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $divisis = Divisi::all();
        $roles = Role::where('role_name', '!=', 'client')->get();
        return view('Adminstrator.users.internal_ptrajaperkasa.edit', compact('user', 'divisis', 'roles'));
    }
    
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'nik' => 'required|string|max:255|unique:users,nik,' . $id,
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jk' => 'required|in:L,P',
            'divisi_id' => 'required|exists:divisis,id',
            'role_id' => 'required|exists:roles,id',
            'status_user' => 'required|in:active,nonactive',
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->nik = $validatedData['nik'];
        $user->no_hp = $validatedData['no_hp'];
        $user->alamat = $validatedData['alamat'];
        $user->tgl_lahir = $validatedData['tgl_lahir'];
        $user->jk = $validatedData['jk'];
        $user->divisi_id = $validatedData['divisi_id'];
        $user->role_id = $validatedData['role_id'];
        $user->status_user = $validatedData['status_user'];
    
        if ($request->hasFile('file_foto')) {
            // Hapus file foto lama jika ada
            if ($user->file_foto) {
                Storage::delete('public/client/photo-profile/' . $user->file_foto);
            }
    
            $fileFoto = $request->file('file_foto');
            $fileNameFoto = time() . '_' . $fileFoto->getClientOriginalName();
            $fileFoto->storeAs('public/client/photo-profile', $fileNameFoto);
            $user->file_foto = $fileNameFoto;
        }
    
        if ($request->hasFile('file_ktp')) {
            // Hapus file KTP lama jika ada
            if ($user->file_ktp) {
                Storage::delete('public/client/file_ktp/' . $user->file_ktp);
            }
    
            $fileKtp = $request->file('file_ktp');
            $fileNameKtp = time() . '_' . $fileKtp->getClientOriginalName();
            $fileKtp->storeAs('public/client/file_ktp', $fileNameKtp);
            $user->file_ktp = $fileNameKtp;
        }
    
        $user->save();
    
        return redirect()->route('userslist')->with('success', 'User berhasil diperbarui.');
    }
    
    public function deletepegawai($id) {
        $user = User::findOrFail($id);
    
        // Hapus file foto jika ada
        if ($user->file_foto) {
            Storage::delete('public/client/photo-profile/' . $user->file_foto);
        }
    
        // Hapus file KTP jika ada
        if ($user->file_ktp) {
            Storage::delete('public/client/file_ktp/' . $user->file_ktp);
        }
    
        $user->delete();
    
        return redirect()->route('userslist')->with('success', 'User berhasil dihapus.');
    }
    
    
    /* Users Client External PT Raja Perkasa */
    public function getclient() {
        $data = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })
        ->select('id', 'name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user', 'mitra_id', 'status_pic_perusahaan')
        ->with(['documentKerjasamaClient', 'mitra'])
        ->get();
        
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

    public function updateStatusUser(Request $request, $id) {
        $request->validate([
            'status_user' => 'required|in:active,nonactive',
        ]);
    
        $user = User::find($id);
    
        if (!$user || $user->role->role_name != 'client') {
            return redirect()->route('userslisteclient')->with('error', 'Pengguna tidak ditemukan atau bukan client.');
        }
    
        $user->status_user = $request->status_user;
    
        // Update status_pic_perusahaan based on the status_user
        if ($request->status_user == 'nonactive') {
            $user->status_pic_perusahaan = 'calon_client';
        } else {
            // Optionally, handle other logic for when the user is active
            $documentKerjasama = $user->documentKerjasamaClient;
            if ($documentKerjasama && $documentKerjasama->status_kerjasama == 'diterima') {
                $user->status_pic_perusahaan = 'client';
            }
        }
    
        $user->save();
    
        return redirect()->route('userslisteclient', $id)->with('success', 'Status pengguna berhasil diperbarui.');
    }
    

    public function getKerjasamaData($id) {
        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $id)->first();

        if (!$dataKerjasama) {
            return response()->json(['error' => 'Data kerja sama tidak ditemukan.'], 404);
        }

        return response()->json($dataKerjasama);
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
    
        return redirect()->route('userslisteclient')->with('success', 'Status kerja sama berhasil diperbarui.');
    }
    
    
    public function deleteClient($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('userslisteclient')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Hapus dokumen kerjasama terkait
        Document_Kerjasama_Client::where('user_id', $id)->delete();

        // Hapus pengguna
        $user->delete();

        return redirect()->route('userslisteclient')->with('success', 'Pengguna dan dokumen kerjasama berhasil dihapus.');
    }
}
