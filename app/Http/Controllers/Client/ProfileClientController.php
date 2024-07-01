<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Mitra;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Client.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_hp' => 'required|numeric|digits_between:10,15',
            'nik' => 'required|numeric|digits:16|unique:users,nik,' . $user->id,
            'file_ktp' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'company_name' => 'required|string|max:255',
        ]);

        $company_name = $request->company_name;
        $mitra = Mitra::firstOrCreate(
            ['name_mitra' => $company_name],
            ['image' => 'default.png', 'status_mitra' => 'nonactive']
        );

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'mitra_id' => $mitra->id,
        ]);

        if ($request->hasFile('file_ktp')) {
            $fileKtp = $request->file('file_ktp');
            $fileKtpName = Str::uuid() . '.' . $fileKtp->getClientOriginalExtension();
            $fileKtp->storeAs('public/client/file_ktp', $fileKtpName);
            $user->file_ktp = $fileKtpName;
        }

        if ($request->hasFile('file_foto')) {
            $fileFoto = $request->file('file_foto');
            $fileFotoName = Str::uuid() . '.' . $fileFoto->getClientOriginalExtension();
            $fileFoto->storeAs('public/client/photo-profile', $fileFotoName);
            $user->file_foto = $fileFotoName;
        }

        $user->save();

        return redirect()->route('profileclient')->with('success1', 'Profil berhasil diperbarui.<br>Lengkapi profil Anda untuk mengajukan kerjasama mitra.');
    }
}
