<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AbsenKaryawan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AbsensiKaryawanController extends Controller
{
    public function absenkaryawan()
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'karyawan') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $alreadyAbsence = AbsenKaryawan::where('user_id', $user->id)
                        ->whereDate('tanggal_absen', Carbon::today())
                        ->exists();

        return view('Karyawan.absen.absenkaryawan', compact('user', 'alreadyAbsence'));
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
        $currentTime = Carbon::now();

       
        $minAbsenTime = Carbon::createFromTime(0, 33, 0);
        $maxAbsenTime = Carbon::createFromTime(0, 35, 0);

        if ($currentTime->lt($minAbsenTime)) {
            return redirect()->back()->with('error', 'Absen masuk hanya dapat dilakukan mulai pukul 08:00 WIB.');
        }

        if ($currentTime->gt($maxAbsenTime)) {
            return redirect()->back()->with('error', 'Anda terlambat lebih dari 10 menit. Anda dianggap tidak hadir.');
        }

        $existingAbsen = AbsenKaryawan::where('user_id', $user_id)
            ->whereDate('tanggal_absen', $tanggal_absen)
            ->first();

        if ($existingAbsen) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        $data = $request->except(['created_at', 'updated_at']);
        $data['user_id'] = $user_id;

        if ($request->status_absen == 'hadir') {
            $data['waktu_datang_kehadiran'] = $currentTime;

            if ($request->input('bukti_kehadiran')) {
                $image = $request->input('bukti_kehadiran');
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10) . '.' . 'png';
                Storage::disk('public')->put('bukti_kehadiran/' . $imageName, base64_decode($image));
                $data['bukti_kehadiran'] = 'bukti_kehadiran/' . $imageName;
            }

            $data['status_absensi'] = 'hadir';
        } else {
            $data['waktu_datang_kehadiran'] = null;
            $data['bukti_kehadiran'] = null;
            $data['status_absensi'] = $request->status_absen;
        }

        if ($request->hasFile('surat_izin_sakit')) {
            $filePath = $request->file('surat_izin_sakit')->store('public/surat_izin_sakit');
            $data['surat_izin_sakit'] = str_replace('public/', '', $filePath);
        }

        AbsenKaryawan::create($data);

        Carbon::setLocale('id');
        $dayName = Carbon::parse($tanggal_absen)->translatedFormat('l');
        $time = $currentTime->format('H:i:s');

        return redirect()->route('absenkaryawan')->with('success', "Absen masuk berhasil disimpan pada hari $dayName pukul $time WIB.");
    }

    public function absenkaryawanpulang()
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'karyawan') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $alreadyCheckedOut = AbsenKaryawan::where('user_id', $user->id)
                            ->whereDate('tanggal_absen', Carbon::today())
                            ->whereNotNull('waktu_pulang_kehadiran')
                            ->exists();

        return view('Karyawan.absen.absenkaryawanpulang', compact('user', 'alreadyCheckedOut'));
    }

    public function prosesabsenkaryawanpulang(Request $request)
    {
        $request->validate([
            'tanggal_absen' => 'required|date',
            'waktu_pulang_kehadiran' => 'required|date_format:H:i:s',
        ]);

        $user_id = Auth::id();
        $tanggal_absen = $request->input('tanggal_absen');

        $absen = AbsenKaryawan::where('user_id', $user_id)
            ->whereDate('tanggal_absen', $tanggal_absen)
            ->first();

        if (!$absen) {
            return redirect()->back()->with('error', 'Data absen masuk tidak ditemukan.');
        }

        if ($absen->waktu_pulang_kehadiran) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
        }

        $waktuPulang = Carbon::parse($tanggal_absen . ' ' . $request->waktu_pulang_kehadiran);

        $absen->update([
            'waktu_pulang_kehadiran' => $waktuPulang,
            'status_absensi' => 'hadir' // Update status menjadi 'hadir' on check-out
        ]);

        Carbon::setLocale('id');
        $dayName = Carbon::parse($tanggal_absen)->translatedFormat('l');
        $time = $waktuPulang->format('H:i:s');

        return redirect()->route('absenkaryawanpulang')->with('success', "Absen pulang berhasil disimpan pada hari $dayName pukul $time WIB.");
    }

    public function createDailyAttendance()
    {
        $karyawanRoleId = 6;
        $karyawan = User::where('role_id', $karyawanRoleId)->get();
        $currentDate = Carbon::today();
        $cutoffTime = Carbon::today()->setTime(0, 35, 0); // Cutoff time is 8 PM

        if (Carbon::now()->gte($cutoffTime)) {
            foreach ($karyawan as $k) {
                $absen = AbsenKaryawan::firstOrCreate(
                    ['user_id' => $k->id, 'tanggal_absen' => $currentDate],
                    ['status_absensi' => 'tidak_hadir']
                );

                // Jika karyawan hanya absen masuk dan belum absen pulang
                if ($absen->status_absensi == 'hadir' && !$absen->waktu_pulang_kehadiran) {
                    $absen->update(['status_absensi' => 'tidak_hadir']);
                }
            }
        }
    }

    public function listdataabsenkaryawan()
    {
        // Panggil fungsi createDailyAttendance untuk memperbarui status
        $this->createDailyAttendance();

        $user_id = Auth::id();
        $absens = AbsenKaryawan::where('user_id', $user_id)
            ->orderBy('tanggal_absen', 'desc')
            ->get();

        return view('Karyawan.absen.listdata', compact('absens'));
    }
}
