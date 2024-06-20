<?php

namespace App\Http\Controllers\Autentikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('Autentikasi.login');
    }
    
    public function loginproses(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');
    
            $validationRules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
    
            $request->validate($validationRules);
    
            if (Auth::attempt($credentials, $remember)) {
                // Check if the user's status is active
                if (Auth::user()->status_user !== 'active') {
                    Auth::logout();
                    return redirect('/login')->with('error', 'Your account is inactive. Please contact support.');
                }

                $request->session()->regenerate();
    
                // Redirect based on role
                $userRole = Auth::user()->role->role_name;
    
                if ($userRole === 'admin') {
                    return redirect()->intended('/adminstrator/dashboard')->with('success', 'Login successful');
                } elseif ($userRole === 'owner') {
                    return redirect()->intended('/owner/dashboard')->with('success', 'Login successful');
                } elseif ($userRole === 'hrd') {
                    return redirect()->intended('/hrd/dashboard')->with('success', 'Login successful');
                } elseif ($userRole === 'karyawan') {
                    return redirect()->intended('/karyawan/dashboard')->with('success', 'Login successful');
                } elseif ($userRole === 'manajer') {
                    return redirect()->intended('/manajer/dashboard')->with('success', 'Login successful');
                } elseif ($userRole === 'client') {
                    return redirect()->intended('/client/profile')->with('success', 'Login successful');
                }
            } else {
                throw new \Exception('Authentication failed');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'The email or password you entered is incorrect.');
        }
    }
    
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout successful');
    }
}
