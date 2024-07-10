<?php

namespace App\Http\Controllers\Autentikasi;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Document_Kerjasama_Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $mitras = Mitra::whereHas('users', function($query) {
            $query->where('status_pic_perusahaan', 'client');
        })->whereHas('users.documentKerjasamaClient', function($query) {
            $query->where('status_kerjasama', 'diterima');
        })->get();

        return view('Autentikasi.register', compact('mitras'));
    }

    public function registerproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'password' => 'required|min:6',
            'new_company_name' => 'required_if:company_name,Perusahaan Tidak Terdaftar'
        ]);

        if ($validator->fails()) {
            Log::info('Validation failed', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $company_name = $request->company_name;
        $mitra = null;

        try {
            if ($company_name === 'Perusahaan Tidak Terdaftar') {
                Log::info('Creating new mitra: ' . $request->new_company_name);
                $mitra = Mitra::create([
                    'name_mitra' => $request->new_company_name,
                    'image' => 'default.png',
                    'status_mitra' => 'nonactive',
                ]);

                Log::info('Creating new user for new mitra');
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'password' => Hash::make($request->password),
                    'role_id' => 4,
                    'mitra_id' => $mitra->id,
                    'status_pic_perusahaan' => 'calon_client',
                    'status_user' => 'active',
                ]);

                Log::info('Inserting data into document_kerjasama_clients table');
                Document_Kerjasama_Client::create([
                    'user_id' => $user->id,
                    'data_sales_id' => null,
                    'data_manajer_id' => null,
                    'data_direktur_id' => null,
                    'data_bank_id' => null,
                    'data_legalitas_id' => null,
                    'status_kerjasama' => 'ditunggu',
                    'keterangan_status_kerjasama' => null,
                    'data_kepemilikan_saham' => null,
                    'situs_web' => null,
                    'email_perusahaan' => $request->email,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
            } else {
                Log::info('Finding existing mitra: ' . $company_name);
                $mitra = Mitra::where('name_mitra', $company_name)->first();
                if (!$mitra) {
                    Log::info('Nama perusahaan tidak valid: ' . $company_name);
                    return redirect()->back()->with('error', 'Nama perusahaan tidak valid.')->withInput();
                }

                if ($request->user_id) {
                    Log::info('Updating existing user: ' . $request->user_id);
                    $user = User::find($request->user_id);
                    if ($user) {
                        $user->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'no_hp' => $request->no_hp,
                            'password' => Hash::make($request->password),
                            'mitra_id' => $mitra->id,
                            'status_pic_perusahaan' => 'client',
                            'status_user' => 'active',
                        ]);

                        // Check if email confirmation is required
                        $document = Document_Kerjasama_Client::where('user_id', $user->id)->where('email_perusahaan', $request->email)->first();
                        if (!$document) {
                            return redirect()->back()->with('error', 'Email perusahaan tidak valid.')->withInput();
                        }
                    }
                } else {
                    Log::info('Creating new user for existing mitra');
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'password' => Hash::make($request->password),
                        'role_id' => 4,
                        'mitra_id' => $mitra->id,
                        'status_pic_perusahaan' => 'calon_client',
                        'status_user' => 'active',
                    ]);

                    // Check if email confirmation is required
                    $document = Document_Kerjasama_Client::where('user_id', $user->id)->where('email_perusahaan', $request->email)->first();
                    if (!$document) {
                        return redirect()->back()->with('error', 'Email perusahaan tidak valid.')->withInput();
                    }
                }

                Log::info('Inserting data into document_kerjasama_clients table');
                Document_Kerjasama_Client::create([
                    'user_id' => $user->id,
                    'data_sales_id' => null,
                    'data_manajer_id' => null,
                    'data_direktur_id' => null,
                    'data_bank_id' => null,
                    'data_legalitas_id' => null,
                    'status_kerjasama' => 'ditunggu',
                    'keterangan_status_kerjasama' => null,
                    'data_kepemilikan_saham' => null,
                    'situs_web' => null,
                    'email_perusahaan' => $request->email,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
            }
        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal Melakukan Registrasi: ' . $e->getMessage())->withInput();
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
