<?php

namespace App\Http\Controllers\Autentikasi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Autentikasi.register');
    }

    public function registerproses(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'no_hp' => 'required',
                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'role_id' => 4,
            ]);

            return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', 'Gagal Melakukan Registrasi');
        }
    }
}
