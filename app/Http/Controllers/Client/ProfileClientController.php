<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->nik = $request->nik;

        if ($request->hasFile('file_ktp')) {
            $fileKtp = $request->file('file_ktp');
            $fileKtpName = Str::uuid() . '.' . $fileKtp->getClientOriginalExtension();
            $pathKtp = $fileKtp->storeAs('public/client/file_ktp', $fileKtpName);
            $user->file_ktp = $pathKtp;
        }

        if ($request->hasFile('file_foto')) {
            $fileFoto = $request->file('file_foto');
            $fileFotoName = Str::uuid() . '.' . $fileFoto->getClientOriginalExtension();
            $pathFoto = $fileFoto->storeAs('public/client/photo-profile', $fileFotoName);
            $user->file_foto = $pathFoto;
        }

        $user->save();

        return redirect()->route('profileclient')->with('success', 'Profile updated successfully');
    }
}
