<?php

namespace App\Http\Controllers\Client;

use App\Models\DataBank;
use App\Models\DataSales;
use App\Models\DataManajer;
use Illuminate\Http\Request;
use App\Models\Datalegalitas;
use App\Models\DataDirekturUtama;
use App\Models\Document_Kerjasama_Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProposalMitraClientController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $user->id)->first();

        // Cek apakah profil pengguna sudah lengkap
        $profileCompleted = $user->name && $user->email && $user->no_hp && $user->nik && $user->file_ktp && $user->file_foto;

        return view('Client.pengajuankerjasamamitra', compact('dataKerjasama', 'profileCompleted'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        // Cek apakah profil pengguna sudah lengkap
        $profileCompleted = $user->name && $user->email && $user->no_hp && $user->nik && $user->file_ktp && $user->file_foto;
        if (!$profileCompleted) {
            return redirect()->route('profileclient')->with('error', 'Lengkapi profil Anda terlebih dahulu.');
        }

        $validatedData = $request->validate([
            'situs_web' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'sales_nama_lengkap' => 'required|string|max:255',
            'sales_no_hp' => 'required|string|max:255',
            'sales_email' => 'required|email|max:255',
            'sales_jabatan' => 'required|string|max:255',
            'manajer_nama_lengkap' => 'required|string|max:255',
            'manajer_no_hp' => 'required|string|max:255',
            'manajer_email' => 'required|email|max:255',
            'manajer_jabatan' => 'required|string|max:255',
            'direktur_nama_lengkap' => 'required|string|max:255',
            'direktur_no_hp' => 'required|string|max:255',
            'direktur_email' => 'required|email|max:255',
            'direktur_jabatan' => 'required|string|max:255',
            'pemilik_saham' => 'required|string|max:255',
            'bank_nama_pemilik' => 'required|string|max:255',
            'bank_no_rekening' => 'required|integer',
            'bank_nama_bank' => 'required|string|max:255',
            'bank_cabang_bank' => 'required|string|max:255',
            'bank_alamat_bank' => 'required|string|max:1000',
            'legalitas_no_akta' => 'required|string|max:255',
            'legalitas_file_akta' => 'nullable|file|mimes:pdf',
            'legalitas_no_siup' => 'required|string|max:255',
            'legalitas_file_siup' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_siup' => 'required|date',
            'legalitas_no_tdp' => 'required|string|max:255',
            'legalitas_file_tdp' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_tdp' => 'required|date',
            'legalitas_no_skdp' => 'required|string|max:255',
            'legalitas_file_skdp' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_skdp' => 'required|date',
            'legalitas_no_iujk' => 'required|string|max:255',
            'legalitas_file_iujk' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_iujk' => 'required|date',
            'legalitas_file_profile_perusahaan' => 'nullable|file|mimes:pdf',
            'legalitas_file_dokumen_kebenaran' => 'nullable|file|mimes:pdf',
        ]);

        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $user->id)->first();

        if ($dataKerjasama) {
            return redirect()->route('pengajuankerjasama')->with('error', 'Pengajuan sudah pernah dilakukan. Silakan update data jika diperlukan.');
        }

        // Handle file uploads
        $aktaPath = $request->file('legalitas_file_akta') ? $request->file('legalitas_file_akta')->store('legalitas', 'public') : null;
        $siupPath = $request->file('legalitas_file_siup') ? $request->file('legalitas_file_siup')->store('legalitas', 'public') : null;
        $tdpPath = $request->file('legalitas_file_tdp') ? $request->file('legalitas_file_tdp')->store('legalitas', 'public') : null;
        $skdpPath = $request->file('legalitas_file_skdp') ? $request->file('legalitas_file_skdp')->store('legalitas', 'public') : null;
        $iujkPath = $request->file('legalitas_file_iujk') ? $request->file('legalitas_file_iujk')->store('legalitas', 'public') : null;
        $profilePath = $request->file('legalitas_file_profile_perusahaan') ? $request->file('legalitas_file_profile_perusahaan')->store('legalitas', 'public') : null;
        $dokumenKebenaranPath = $request->file('legalitas_file_dokumen_kebenaran') ? $request->file('legalitas_file_dokumen_kebenaran')->store('legalitas', 'public') : null;

        // Create related records
        $dataSales = DataSales::create([
            'name_lengkap' => $request->input('sales_nama_lengkap'),
            'no_hp' => $request->input('sales_no_hp'),
            'email' => $request->input('sales_email'),
            'jabatan' => $request->input('sales_jabatan'),
        ]);

        $dataManajer = DataManajer::create([
            'nama_lengkap' => $request->input('manajer_nama_lengkap'),
            'no_hp' => $request->input('manajer_no_hp'),
            'email' => $request->input('manajer_email'),
            'jabatan' => $request->input('manajer_jabatan'),
        ]);

        $dataDirektur = DataDirekturUtama::create([
            'nama_lengkap' => $request->input('direktur_nama_lengkap'),
            'no_hp' => $request->input('direktur_no_hp'),
            'email' => $request->input('direktur_email'),
            'jabatan' => $request->input('direktur_jabatan'),
        ]);

        $dataBank = DataBank::create([
            'nama_pemilik_rekening' => $request->input('bank_nama_pemilik'),
            'no_rekening' => $request->input('bank_no_rekening'),
            'nama_bank' => $request->input('bank_nama_bank'),
            'cabang_bank' => $request->input('bank_cabang_bank'),
            'alamat_bank' => $request->input('bank_alamat_bank'),
        ]);

        $dataLegalitas = Datalegalitas::create([
            'no_akta' => $request->input('legalitas_no_akta'),
            'file_akta' => $aktaPath,
            'no_siup' => $request->input('legalitas_no_siup'),
            'file_siup' => $siupPath,
            'date_end_siup' => $request->input('legalitas_date_end_siup'),
            'no_tdp' => $request->input('legalitas_no_tdp'),
            'file_tdp' => $tdpPath,
            'date_end_tdp' => $request->input('legalitas_date_end_tdp'),
            'no_skdp' => $request->input('legalitas_no_skdp'),
            'file_skdp' => $skdpPath,
            'date_end_skdp' => $request->input('legalitas_date_end_skdp'),
            'no_iujk' => $request->input('legalitas_no_iujk'),
            'file_iujk' => $iujkPath,
            'date_end_iujk' => $request->input('legalitas_date_end_iujk'),
            'file_profile_perusahaan' => $profilePath,
            'file_dokumen_kebenaran' => $dokumenKebenaranPath,
        ]);

        // Create new data
        Document_Kerjasama_Client::create([
            'user_id' => $user->id,
            'data_sales_id' => $dataSales->id,
            'data_manajer_id' => $dataManajer->id,
            'data_direktur_id' => $dataDirektur->id,
            'data_bank_id' => $dataBank->id,
            'data_legalitas_id' => $dataLegalitas->id,
            'data_kepemilikan_saham' => $request->input('pemilik_saham'),
            'situs_web' => $request->input('situs_web'),
            'email_perusahaan' => $request->input('email_perusahaan'),
            'status_kerjasama' => 'ditunggu',
            'keterangan_status_kerjasama' => 'Baik Terimakasih Sudah Mengirimkan Berkas Perusahaan Anda, Silahkan Ditunggu !',
        ]);

        return redirect()->route('pengajuankerjasama')->with('success', 'Pengajuan kerjasama berhasil dikirim.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'situs_web' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'sales_nama_lengkap' => 'required|string|max:255',
            'sales_no_hp' => 'required|string|max:255',
            'sales_email' => 'required|email|max:255',
            'sales_jabatan' => 'required|string|max:255',
            'manajer_nama_lengkap' => 'required|string|max:255',
            'manajer_no_hp' => 'required|string|max:255',
            'manajer_email' => 'required|email|max:255',
            'manajer_jabatan' => 'required|string|max:255',
            'direktur_nama_lengkap' => 'required|string|max:255',
            'direktur_no_hp' => 'required|string|max:255',
            'direktur_email' => 'required|email|max:255',
            'direktur_jabatan' => 'required|string|max:255',
            'pemilik_saham' => 'required|string|max:255',
            'bank_nama_pemilik' => 'required|string|max:255',
            'bank_no_rekening' => 'required|integer',
            'bank_nama_bank' => 'required|string|max:255',
            'bank_cabang_bank' => 'required|string|max:255',
            'bank_alamat_bank' => 'required|string|max:1000',
            'legalitas_no_akta' => 'required|string|max:255',
            'legalitas_file_akta' => 'nullable|file|mimes:pdf',
            'legalitas_no_siup' => 'required|string|max:255',
            'legalitas_file_siup' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_siup' => 'required|date',
            'legalitas_no_tdp' => 'required|string|max:255',
            'legalitas_file_tdp' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_tdp' => 'required|date',
            'legalitas_no_skdp' => 'required|string|max:255',
            'legalitas_file_skdp' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_skdp' => 'required|date',
            'legalitas_no_iujk' => 'required|string|max:255',
            'legalitas_file_iujk' => 'nullable|file|mimes:pdf',
            'legalitas_date_end_iujk' => 'required|date',
            'legalitas_file_profile_perusahaan' => 'nullable|file|mimes:pdf',
            'legalitas_file_dokumen_kebenaran' => 'nullable|file|mimes:pdf',
        ]);

        $user_id = Auth::id();
        $dataKerjasama = Document_Kerjasama_Client::find($id);

        if (!$dataKerjasama || $dataKerjasama->user_id !== $user_id) {
            return redirect()->route('pengajuankerjasama')->with('error', 'Anda tidak memiliki akses untuk mengupdate data ini.');
        }

        // Handle file uploads
        $aktaPath = $request->file('legalitas_file_akta') ? $request->file('legalitas_file_akta')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_akta;
        $siupPath = $request->file('legalitas_file_siup') ? $request->file('legalitas_file_siup')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_siup;
        $tdpPath = $request->file('legalitas_file_tdp') ? $request->file('legalitas_file_tdp')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_tdp;
        $skdpPath = $request->file('legalitas_file_skdp') ? $request->file('legalitas_file_skdp')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_skdp;
        $iujkPath = $request->file('legalitas_file_iujk') ? $request->file('legalitas_file_iujk')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_iujk;
        $profilePath = $request->file('legalitas_file_profile_perusahaan') ? $request->file('legalitas_file_profile_perusahaan')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_profile_perusahaan;
        $dokumenKebenaranPath = $request->file('legalitas_file_dokumen_kebenaran') ? $request->file('legalitas_file_dokumen_kebenaran')->store('legalitas', 'public') : $dataKerjasama->dataLegalitas->file_dokumen_kebenaran;

        // Update related records
        if ($dataKerjasama->dataSales) {
            $dataKerjasama->dataSales->update([
                'name_lengkap' => $request->input('sales_nama_lengkap'),
                'no_hp' => $request->input('sales_no_hp'),
                'email' => $request->input('sales_email'),
                'jabatan' => $request->input('sales_jabatan'),
            ]);
        }

        if ($dataKerjasama->dataManajer) {
            $dataKerjasama->dataManajer->update([
                'nama_lengkap' => $request->input('manajer_nama_lengkap'),
                'no_hp' => $request->input('manajer_no_hp'),
                'email' => $request->input('manajer_email'),
                'jabatan' => $request->input('manajer_jabatan'),
            ]);
        }

        if ($dataKerjasama->dataDirektur) {
            $dataKerjasama->dataDirektur->update([
                'nama_lengkap' => $request->input('direktur_nama_lengkap'),
                'no_hp' => $request->input('direktur_no_hp'),
                'email' => $request->input('direktur_email'),
                'jabatan' => $request->input('direktur_jabatan'),
            ]);
        }

        if ($dataKerjasama->dataBank) {
            $dataKerjasama->dataBank->update([
                'nama_pemilik_rekening' => $request->input('bank_nama_pemilik'),
                'no_rekening' => $request->input('bank_no_rekening'),
                'nama_bank' => $request->input('bank_nama_bank'),
                'cabang_bank' => $request->input('bank_cabang_bank'),
                'alamat_bank' => $request->input('bank_alamat_bank'),
            ]);
        }

        if ($dataKerjasama->dataLegalitas) {
            $dataKerjasama->dataLegalitas->update([
                'no_akta' => $request->input('legalitas_no_akta'),
                'file_akta' => $aktaPath,
                'no_siup' => $request->input('legalitas_no_siup'),
                'file_siup' => $siupPath,
                'date_end_siup' => $request->input('legalitas_date_end_siup'),
                'no_tdp' => $request->input('legalitas_no_tdp'),
                'file_tdp' => $tdpPath,
                'date_end_tdp' => $request->input('legalitas_date_end_tdp'),
                'no_skdp' => $request->input('legalitas_no_skdp'),
                'file_skdp' => $skdpPath,
                'date_end_skdp' => $request->input('legalitas_date_end_skdp'),
                'no_iujk' => $request->input('legalitas_no_iujk'),
                'file_iujk' => $iujkPath,
                'date_end_iujk' => $request->input('legalitas_date_end_iujk'),
                'file_profile_perusahaan' => $profilePath,
                'file_dokumen_kebenaran' => $dokumenKebenaranPath,
            ]);
        }

        // Update existing data
        $dataKerjasama->update([
            'situs_web' => $request->input('situs_web'),
            'email_perusahaan' => $request->input('email_perusahaan'),
            'data_kepemilikan_saham' => $request->input('pemilik_saham'),
            'status_kerjasama' => 'ditunggu',
        ]);

        return redirect()->route('pengajuankerjasama')->with('success', 'Data kerjasama berhasil diperbarui.');
    }

    public function statuskerjasama()
    {
        $user_id = Auth::id();
        $dataKerjasama = Document_Kerjasama_Client::where('user_id', $user_id)->latest()->first();
    
        return view('Client.statuskerjasamamitra', compact('dataKerjasama'));
    }
}
