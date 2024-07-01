<?php

namespace App\Http\Controllers\Autentikasi;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Document_Kerjasama_Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        // Fetch only mitras that meet the criteria
        $mitras = Mitra::whereHas('users', function($query) {
            $query->where('status_pic_perusahaan', 'client');
        })->whereHas('users.documentKerjasamaClient', function($query) {
            $query->where('status_kerjasama', 'diterima');
        })->get();

        return view('Autentikasi.register', compact('mitras'));
    }

    public function registerproses(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'company_name' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required',
                'password' => 'required|min:6',
            ]);

            $company_name = $request->company_name;
            $mitra = Mitra::where('name_mitra', $company_name)->first();

            if (!$mitra) {
                // Create a new company if it doesn't exist
                $mitra = Mitra::create([
                    'name_mitra' => $company_name,
                    'image' => 'default.png', // Assuming you have a default image or handle the upload separately
                    'status_mitra' => 'nonactive',
                ]);
            }

            // Check if the user already exists
            if ($request->user_id) {
                $user = User::find($request->user_id);
                if ($user) {
                    // Update the existing user
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'password' => Hash::make($request->password),
                        'mitra_id' => $mitra->id,
                        'status_pic_perusahaan' => 'client', // Assuming status is updated to client
                        'status_user' => 'active',
                    ]);
                }
            } else {
                // Create a new user
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'password' => Hash::make($request->password),
                    'role_id' => 4, // Assuming 4 is the role ID for client
                    'mitra_id' => $mitra->id,
                    'status_pic_perusahaan' => 'calon_client',
                    'status_user' => 'active',
                ]);
            }

            return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', 'Gagal Melakukan Registrasi');
        }
    }

    public function getPicDetails(Request $request)
    {
        $company_name = $request->query('company_name');
        $mitra = Mitra::where('name_mitra', $company_name)->first();

        if ($mitra) {
            $user = User::where('mitra_id', $mitra->id)->where('status_pic_perusahaan', 'client')->first();

            if ($user) {
                return response()->json(['success' => true, 'user' => $user]);
            }
        }

        return response()->json(['success' => false]);
    }

    public function confirmEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);
        $document = Document_Kerjasama_Client::where('user_id', $user->id)->where('email_perusahaan', $request->email)->first();

        if ($document) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
