<?php

namespace App\Http\Controllers\Hrd;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManajemenKaryawanController extends Controller
{
    /* Data Divisi Di PT Raja Perkasa */
    public function divisi() {
        $data = Divisi::all();
        return view('Hrd.karyawan.divisi.list', compact('data'));
    }

    public function create() {
        return view('Hrd.karyawan.divisi.create');
    }

    public function createproses(Request $request) {
        $request->validate([
            'divisi_name' => 'required|string|max:255',
        ]);

        Divisi::create([
            'divisi_name' => $request->divisi_name,
        ]);

        return redirect()->route('divisilist')->with('success', 'Data divisi berhasil ditambahkan.');
    }

    public function edit($id) {
        $divisi = Divisi::findOrFail($id);
        return view('Hrd.karyawan.divisi.edit', compact('divisi'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'divisi_name' => 'required|string|max:255',
        ]);

        $divisi = Divisi::findOrFail($id);
        $divisi->update([
            'divisi_name' => $request->divisi_name,
        ]);

        return redirect()->route('divisilist')->with('success', 'Data divisi berhasil diperbarui.');
    }

    public function delete($id) {
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();

        return redirect()->route('divisilist')->with('success', 'Data Divisi berhasil dihapus.');
    }

     /* Data Karyawan */
     public function karyawanlist() {
        $data = User::with('divisi')
                    ->whereHas('role', function($query) {
                        $query->where('role_name', 'karyawan');
                    })
                    ->get();

        return view('Hrd.karyawan.list', compact('data'));
    }

    public function showkaryawanlist($id)
    {
        $user = User::findOrFail($id);
        $divisi = Divisi::all();

        return view('Hrd.karyawan.show', compact('user', 'divisi'));
    }

    public function karyawancreate() {
        $divisi = Divisi::all();
        return view('Hrd.karyawan.create', compact('divisi'));
    }

    public function karyawancreateproses(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'divisi_id' => 'required|exists:divisis,id',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'file_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file_foto = $request->file('file_foto')->store('karyawan/foto', 'public');
        $file_ktp = $request->file('file_ktp')->store('karyawan/ktp', 'public');

        User::create([
            'role_id' => 6, // role_id for karyawan
            'divisi_id' => $request->divisi_id,
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'file_foto' => $file_foto,
            'file_ktp' => $file_ktp,
            'status_user' => 'active',
        ]);

        return redirect()->route('karyawanlist')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function editkaryawan($id) {
        $user = User::findOrFail($id);
        $divisi = Divisi::all();
        return view('Hrd.karyawan.edit', compact('user', 'divisi'));
    }

    public function updatekaryawan(Request $request, $id) {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'nik' => 'required|string|max:255|unique:users,nik,'.$user->id,
            'password' => 'nullable|string|min:8',
            'divisi_id' => 'required|exists:divisis,id',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file_foto = $user->file_foto;
        if ($request->hasFile('file_foto')) {
            $file_foto = $request->file('file_foto')->store('karyawan/foto', 'public');
        }

        $file_ktp = $user->file_ktp;
        if ($request->hasFile('file_ktp')) {
            $file_ktp = $request->file('file_ktp')->store('karyawan/ktp', 'public');
        }

        $user->update([
            'divisi_id' => $request->divisi_id,
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'file_foto' => $file_foto,
            'file_ktp' => $file_ktp,
            'status_user' => 'active',
        ]);

        return redirect()->route('karyawanlist')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function karyawandelete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('karyawanlist')->with('success', 'Data karyawan berhasil dihapus.');
    }
    
}
