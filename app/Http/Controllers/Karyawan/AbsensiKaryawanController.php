<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AbsenKaryawan;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AbsensiKaryawanController extends Controller
{
    /* Absen Karyawan Masuk */
    public function absenkaryawan()
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'karyawan') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('Karyawan.absen.absenkaryawan', compact('user'));
    }

    public function prosesabsenkaryawan(Request $request)
    {
        $request->validate([
            'status_absen' => 'required|in:hadir,izin,sakit,tidak_hadir',
            'tanggal_absen' => 'required|date',
            'waktu_datang_kehadiran' => 'required_if:status_absen,hadir|nullable|date_format:H:i:s',
            'bukti_kehadiran' => 'required_if:status_absen,hadir|nullable',
            'surat_izin_sakit' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $user_id = Auth::id();
        $tanggal_absen = $request->input('tanggal_absen');

        // Periksa apakah sudah ada absen masuk untuk hari ini
        $existingAbsen = AbsenKaryawan::where('user_id', $user_id)
            ->whereDate('tanggal_absen', $tanggal_absen)
            ->first();

        if ($existingAbsen) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        $data = $request->except(['created_at', 'updated_at']);
        $data['user_id'] = $user_id;
        $data['status_absensi'] = $request->status_absen; // Set status absensi

        if ($request->status_absen == 'hadir') {
            // Menggabungkan tanggal dan waktu untuk disimpan ke database
            $data['waktu_datang_kehadiran'] = Carbon::parse($tanggal_absen . ' ' . $request->waktu_datang_kehadiran);

            // Simpan bukti kehadiran dari kamera
            if ($request->input('bukti_kehadiran')) {
                $image = $request->input('bukti_kehadiran'); // base64 encoded image
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10) . '.' . 'png';
                Storage::disk('public')->put('bukti_kehadiran/' . $imageName, base64_decode($image));
                $data['bukti_kehadiran'] = 'bukti_kehadiran/' . $imageName;
            }
        } else {
            $data['waktu_datang_kehadiran'] = null;
            $data['bukti_kehadiran'] = null;
        }

        // Simpan file surat izin sakit
        if ($request->hasFile('surat_izin_sakit')) {
            $filePath = $request->file('surat_izin_sakit')->store('public/surat_izin_sakit');
            $data['surat_izin_sakit'] = str_replace('public/', '', $filePath); // Hanya simpan path relatif
        }

        AbsenKaryawan::create($data);

        return redirect()->route('absenkaryawan')->with('success', 'Absen karyawan berhasil disimpan.');
    }

    /* Absen Karyawan Pulang */
    public function absenkaryawanpulang()
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'karyawan') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('Karyawan.absen.absenkaryawanpulang', compact('user'));
    }

    public function prosesabsenkaryawanpulang(Request $request)
    {
        $request->validate([
            'tanggal_absen' => 'required|date',
            'waktu_pulang_kehadiran' => 'required|date_format:H:i:s',
        ]);

        $user_id = Auth::id();
        $tanggal_absen = $request->input('tanggal_absen');

        // Periksa apakah sudah ada absen masuk untuk hari ini
        $absen = AbsenKaryawan::where('user_id', $user_id)
            ->whereDate('tanggal_absen', $tanggal_absen)
            ->first();

        if (!$absen) {
            return redirect()->back()->with('error', 'Data absen masuk tidak ditemukan.');
        }

        if ($absen->waktu_pulang_kehadiran) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
        }

        // Menggabungkan tanggal dan waktu untuk disimpan ke database
        $waktuPulang = Carbon::parse($tanggal_absen . ' ' . $request->waktu_pulang_kehadiran);

        $absen->update([
            'waktu_pulang_kehadiran' => $waktuPulang,
        ]);

        // Update status absen menjadi hadir jika waktu datang dan waktu pulang dicatat
        if ($absen->waktu_datang_kehadiran && $absen->waktu_pulang_kehadiran) {
            $absen->update(['status_absensi' => 'hadir']);
        }

        Carbon::setLocale('id');
        $dayName = Carbon::parse($tanggal_absen)->translatedFormat('l'); // Nama hari dalam bahasa Indonesia
        $time = $waktuPulang->format('H:i:s');

        return redirect()->route('absenkaryawanpulang')->with('success', "Absen pulang berhasil disimpan pada hari $dayName pukul $time WIB.");
    }

    /* Update Status Tidak Hadir jika waktu pulang tidak diisi dalam 24 jam */
    public function updateStatusTidakHadir()
    {
        $absens = AbsenKaryawan::whereNull('waktu_pulang_kehadiran')
            ->where('tanggal_absen', '<', Carbon::now()->subDay())
            ->get();

        foreach ($absens as $absen) {
            $absen->update(['status_absensi' => 'tidak_hadir']);
        }
    }

    /* List Data karyawan diri sendiri */
    public function listdataabsenkaryawan()
    {
        $this->updateStatusTidakHadir(); // Panggil metode untuk memperbarui status tidak hadir

        $user_id = Auth::id();
        $absens = AbsenKaryawan::where('user_id', $user_id)
            ->orderBy('tanggal_absen', 'desc')
            ->get();

        return view('Karyawan.absen.listdata', compact('absens'));
    }
}
