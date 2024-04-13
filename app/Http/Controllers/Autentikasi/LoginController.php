<?php

namespace App\Http\Controllers\Autentikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('Autentikasi.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validationRules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $request->validate($validationRules);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            // Assuming the role is directly accessible from the User model
            $userRole = auth()->user()->role->name;

            // Redirect based on role
            if ($userRole === 'Admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($userRole === 'User') {
                return redirect()->intended('user/dashboard');
            }

            return redirect()->intended('/');
        }

        // Check if the email exists
        $emailExists = \App\Models\User::where('email', $request->email)->exists();
        if (!$emailExists) {
            return back()->withErrors([
                'email' => 'The email you entered does not exist.',
            ]);
        }

        // If email exists but password is wrong
        return back()->withErrors([
            'password' => 'The password you entered is incorrect.',
        ]);
    }

    public function register()
    {
        return view('Autentikasi.register');
    }

    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
        $request->validate($validationRules);

        $user = new \App\Models\User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login');
        
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
