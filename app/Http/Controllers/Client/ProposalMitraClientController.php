<?php

namespace App\Http\Controllers\Client;

use App\Models\DataBank;
use App\Models\DataSales;
use App\Models\DataManajer;
use App\Models\DataLegalitas;
use App\Models\DataDirekturUtama;
use App\Models\Document_Kerjasama_Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProposalMitraClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $user->id)->first();

        $profileCompleted = $this->checkProfileCompletion($user);

        return view('Client.pengajuankerjasamamitra', compact('dataKerjasama', 'profileCompleted'));
    }

    public function statuskerjasama()
{
    $user = Auth::user();

    if ($user->role->role_name != 'client') {
        return redirect()->route('profileclient')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    $dataKerjasama = Document_Kerjasama_Client::where('user_id', $user->id)->first();

    // Tambahkan logging untuk memastikan data yang didapat
    Log::info('Data Kerjasama:', ['data' => $dataKerjasama]);

    // Check if all fields in Document_Kerjasama_Client are filled
    $profileCompleted = $this->checkProfileCompletion($user) && $this->checkKerjasamaCompletion($dataKerjasama);

    // Default values when not fully completed
    $defaultStatus = '-';
    $defaultKeterangan = '-';

    if ($profileCompleted && $dataKerjasama && $dataKerjasama->status_kerjasama) {
        $defaultStatus = $dataKerjasama->status_kerjasama;
        $defaultKeterangan = $dataKerjasama->keterangan_status_kerjasama ?: 'Terimakasih Sudah Mengisi Form, Untuk Data Kerja Sama Mitra Sedang Di Cek Oleh Team PT Raja Perkasa';
    }

    return view('Client.statuskerjasamamitra', compact('defaultStatus', 'defaultKeterangan'));
}

/**
 * Check if kerjasama data is completed.
 *
 * @param  \App\Models\Document_Kerjasama_Client  $dataKerjasama
 * @return bool
 */
private function checkKerjasamaCompletion($dataKerjasama)
{
    if (!$dataKerjasama) {
        return false;
    }

    return $dataKerjasama->data_sales_id && $dataKerjasama->data_manajer_id && $dataKerjasama->data_direktur_id &&
           $dataKerjasama->data_bank_id && $dataKerjasama->data_legalitas_id && $dataKerjasama->situs_web &&
           $dataKerjasama->email_perusahaan && $dataKerjasama->data_kepemilikan_saham;
}




    public function create(Request $request)
    {
        $user = Auth::user();
        $profileCompleted = $this->checkProfileCompletion($user);

        if (!$profileCompleted) {
            return redirect()->route('profileclient')->with('error', 'Lengkapi profil Anda terlebih dahulu.');
        }

        $validatedData = $request->validate($this->validationRules());

        DB::beginTransaction();

        try {
            // Simpan file-file legalitas
            $dataLegalitas = $this->storeLegalitasFiles($request);

            // Simpan data sales, manajer, direktur, bank
            $dataSales = DataSales::create($request->only(['name_lengkap', 'no_hp', 'email', 'jabatan']));
            $dataManajer = DataManajer::create($request->only(['nama_lengkap', 'no_hp', 'email', 'jabatan']));
            $dataDirektur = DataDirekturUtama::create($request->only(['nama_lengkap', 'no_hp', 'email', 'jabatan']));
            $dataBank = DataBank::create($request->only(['nama_pemilik_rekening', 'no_rekening', 'nama_bank', 'cabang_bank', 'alamat_bank']));

            // Simpan data kerjasama client
            $documentKerjasama = Document_Kerjasama_Client::create([
                'user_id' => $user->id,
                'situs_web' => $request->input('situs_web'),
                'email_perusahaan' => $request->input('email_perusahaan'),
                'data_sales_id' => $dataSales->id,
                'data_manajer_id' => $dataManajer->id,
                'data_direktur_id' => $dataDirektur->id,
                'data_bank_id' => $dataBank->id,
                'data_legalitas_id' => $dataLegalitas->id,
                'data_kepemilikan_saham' => $request->input('data_kepemilikan_saham'),
                'file_profile_perusahaan' => $request->file('file_profile_perusahaan') ? $request->file('file_profile_perusahaan')->store('legalitas', 'public') : null,
                'file_dokumen_kebenaran' => $request->file('file_dokumen_kebenaran') ? $request->file('file_dokumen_kebenaran')->store('legalitas', 'public') : null,
            ]);

            DB::commit();
            return redirect()->route('pengajuankerjasama')->with('success', 'Pengajuan kerjasama berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Pengajuan kerjasama gagal: ' . $e->getMessage());
            return redirect()->route('pengajuankerjasama')->with('error', 'Pengajuan kerjasama gagal: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate($this->validationRules());

        DB::beginTransaction();

        try {
            $documentKerjasama = Document_Kerjasama_Client::findOrFail($id);

            // Update or create data sales
            $dataSales = $documentKerjasama->dataSales ?: new DataSales;
            $dataSales->fill($request->only(['name_lengkap', 'no_hp', 'email', 'jabatan']));
            $dataSales->save();
            $documentKerjasama->data_sales_id = $dataSales->id;

            // Update or create data manajer
            $dataManajer = $documentKerjasama->dataManajer ?: new DataManajer;
            $dataManajer->fill($request->only(['nama_lengkap', 'no_hp', 'email', 'jabatan']));
            $dataManajer->save();
            $documentKerjasama->data_manajer_id = $dataManajer->id;

            // Update or create data direktur
            $dataDirektur = $documentKerjasama->dataDirektur ?: new DataDirekturUtama;
            $dataDirektur->fill($request->only(['nama_lengkap', 'no_hp', 'email', 'jabatan']));
            $dataDirektur->save();
            $documentKerjasama->data_direktur_id = $dataDirektur->id;

            // Update or create data bank
            $dataBank = $documentKerjasama->dataBank ?: new DataBank;
            $dataBank->fill($request->only(['nama_pemilik_rekening', 'no_rekening', 'nama_bank', 'cabang_bank', 'alamat_bank']));
            $dataBank->save();
            $documentKerjasama->data_bank_id = $dataBank->id;

            // Update or create data legalitas
            $dataLegalitas = $documentKerjasama->dataLegalitas ?: new DataLegalitas;
            $dataLegalitas->fill($request->only([
                'no_akta', 'no_siup', 'date_end_siup', 'no_tdp', 'date_end_tdp', 'no_skdp', 'date_end_skdp', 'no_iujk', 'date_end_iujk', 'data_kepemilikan_saham'
            ]));
            $dataLegalitas->save();
            $documentKerjasama->data_legalitas_id = $dataLegalitas->id;

            // Update legalitas files if provided
            $this->updateLegalitasFiles($dataLegalitas, $request);

            // Update the documentKerjasama record
            $documentKerjasama->update([
                'situs_web' => $request->input('situs_web'),
                'email_perusahaan' => $request->input('email_perusahaan'),
                'data_kepemilikan_saham' => $request->input('data_kepemilikan_saham'),
                'file_profile_perusahaan' => $request->file('file_profile_perusahaan') ? $request->file('file_profile_perusahaan')->store('legalitas', 'public') : $documentKerjasama->file_profile_perusahaan,
                'file_dokumen_kebenaran' => $request->file('file_dokumen_kebenaran') ? $request->file('file_dokumen_kebenaran')->store('legalitas', 'public') : $documentKerjasama->file_dokumen_kebenaran,
            ]);

            DB::commit();
            return redirect()->route('pengajuankerjasama')->with('success', 'Data kerjasama berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Update kerjasama gagal: ' . $e->getMessage());
            return redirect()->route('pengajuankerjasama')->with('error', 'Update kerjasama gagal: ' . $e->getMessage());
        }
    }    
    /**
     * Check if user profile is completed.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    private function checkProfileCompletion($user)
    {
        return $user->name && $user->email && $user->no_hp && $user->nik && $user->file_ktp && $user->file_foto;
    }

    /**
     * Validation rules for create and update methods.
     *
     * @return array
     */
    private function validationRules()
    {
        return [
            'situs_web' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'name_lengkap' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jabatan' => 'required|string|max:255',
            'data_kepemilikan_saham' => 'required|string|max:255',
            'nama_pemilik_rekening' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'nama_bank' => 'required|string|max:255',
            'cabang_bank' => 'required|string|max:255',
            'alamat_bank' => 'required|string|max:1000',
            'no_akta' => 'required|string|max:255',
            'file_akta' => 'nullable|file|mimes:pdf',
            'no_siup' => 'required|string|max:255',
            'file_siup' => 'nullable|file|mimes:pdf',
            'date_end_siup' => 'required|date',
            'no_tdp' => 'required|string|max:255',
            'file_tdp' => 'nullable|file|mimes:pdf',
            'date_end_tdp' => 'required|date',
            'no_skdp' => 'required|string|max:255',
            'file_skdp' => 'nullable|file|mimes:pdf',
            'date_end_skdp' => 'required|date',
            'no_iujk' => 'required|string|max:255',
            'file_iujk' => 'nullable|file|mimes:pdf',
            'date_end_iujk' => 'required|date',
            'file_profile_perusahaan' => 'nullable|file|mimes:pdf',
            'file_dokumen_kebenaran' => 'nullable|file|mimes:pdf',
        ];
    }

    /**
     * Store legalitas files and return the created DataLegalitas instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\DataLegalitas
     */
    private function storeLegalitasFiles(Request $request)
    {
        $dataLegalitas = DataLegalitas::create($request->only([
            'no_akta', 'no_siup', 'date_end_siup', 'no_tdp', 'date_end_tdp', 'no_skdp', 'date_end_skdp', 'no_iujk', 'date_end_iujk', 'data_kepemilikan_saham'
        ]));

        // Simpan file-file legalitas
        $dataLegalitas->update([
            'file_akta' => $request->file('file_akta') ? $request->file('file_akta')->store('legalitas', 'public') : null,
            'file_siup' => $request->file('file_siup') ? $request->file('file_siup')->store('legalitas', 'public') : null,
            'file_tdp' => $request->file('file_tdp') ? $request->file('file_tdp')->store('legalitas', 'public') : null,
            'file_skdp' => $request->file('file_skdp') ? $request->file('file_skdp')->store('legalitas', 'public') : null,
            'file_iujk' => $request->file('file_iujk') ? $request->file('file_iujk')->store('legalitas', 'public') : null,
            'file_profile_perusahaan' => $request->file('file_profile_perusahaan') ? $request->file('file_profile_perusahaan')->store('legalitas', 'public') : null,
            'file_dokumen_kebenaran' => $request->file('file_dokumen_kebenaran') ? $request->file('file_dokumen_kebenaran')->store('legalitas', 'public') : null,
        ]);

        return $dataLegalitas;
    }

    /**
     * Update legalitas files if provided.
     *
     * @param  \App\Models\DataLegalitas  $dataLegalitas
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function updateLegalitasFiles(DataLegalitas $dataLegalitas, Request $request)
    {
        if ($request->hasFile('file_akta')) {
            $dataLegalitas->update(['file_akta' => $request->file('file_akta')->store('legalitas', 'public')]);
        }
        if ($request->hasFile('file_siup')) {
            $dataLegalitas->update(['file_siup' => $request->file('file_siup')->store('legalitas', 'public')]);
        }
        if ($request->hasFile('file_tdp')) {
            $dataLegalitas->update(['file_tdp' => $request->file('file_tdp')->store('legalitas', 'public')]);
        }
        if ($request->hasFile('file_skdp')) {
            $dataLegalitas->update(['file_skdp' => $request->file('file_skdp')->store('legalitas', 'public')]);
        }
        if ($request->hasFile('file_iujk')) {
            $dataLegalitas->update(['file_iujk' => $request->file('file_iujk')->store('legalitas', 'public')]);
        }
        if ($request->hasFile('file_profile_perusahaan')) {
            $dataLegalitas->update(['file_profile_perusahaan' => $request->file('file_profile_perusahaan')->store('legalitas', 'public')]);
        }
        if ($request->hasFile('file_dokumen_kebenaran')) {
            $dataLegalitas->update(['file_dokumen_kebenaran' => $request->file('file_dokumen_kebenaran')->store('legalitas', 'public')]);
        }
    }
}
