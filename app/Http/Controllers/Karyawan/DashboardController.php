<?php

namespace App\Http\Controllers\Karyawan;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Role;
use App\Models\User;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use App\Models\Pengundurandiri;
use App\Models\List_Data_Proyek;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ListPeringatanKaryawan;
use Illuminate\Support\Facades\Storage;
use App\Models\Document_Kerjasama_Client;

class DashboardController extends Controller
{
        public function index(Request $request)
    {
        // Mengambil data user yang sedang login
        $userId = Auth::id();

        // Total Karyawan (data untuk user yang login)
        $totalKaryawan = User::where('id', $userId)->count();

        // Data Kehadiran, Ketidakhadiran, Izin, Sakit, dan Cuti per Karyawan (data untuk user yang login)
        $kehadiranPerKaryawan = User::where('id', $userId)->withCount([
            'absens as total_hadir' => function ($query) {
                $query->where('status_absensi', 'hadir');
            },
            'absens as total_tidak_hadir' => function ($query) {
                $query->where('status_absensi', 'tidak_hadir');
            },
            'absens as total_izin' => function ($query) {
                $query->where('status_absensi', 'izin');
            },
            'absens as total_sakit' => function ($query) {
                $query->where('status_absensi', 'sakit');
            },
            'cutis as total_cuti' => function ($query) {
                $query->where('status_cuti', 'disetujui');
            }
        ])->get();

        // Total Izin/Sakit
        $totalIzinSakit = $kehadiranPerKaryawan->sum('total_izin') + $kehadiranPerKaryawan->sum('total_sakit');

        // Data Cuti per Karyawan (data untuk user yang login)
        $cutiKaryawan = User::where('id', $userId)->with(['divisi', 'cutis'])->get();

        // Data Peringatan per Karyawan (data untuk user yang login)
        $peringatanPerKaryawan = ListPeringatanKaryawan::where('user_id', $userId)->get();

        // Current month for filter
        $currentMonth = Carbon::now()->format('Y-m');

        // Kehadiran grouped by month (data untuk user yang login)
        $kehadiranByMonth = AbsenKaryawan::where('user_id', $userId)
            ->selectRaw('DATE_FORMAT(tanggal_absen, "%Y-%m") as month, status_absensi, COUNT(*) as total')
            ->groupBy('month', 'status_absensi')
            ->get()
            ->groupBy('month');

        return view('Karyawan.dashboard.dashboard', compact(
            'totalKaryawan',
            'kehadiranPerKaryawan',
            'cutiKaryawan',
            'peringatanPerKaryawan',
            'totalIzinSakit',
            'currentMonth',
            'kehadiranByMonth'
        ));
    }

    


    public function editkaryawanProfile($id) {
        $user = User::findOrFail($id);
        $user->tgl_lahir_formatted = $user->tgl_lahir ? Carbon::parse($user->tgl_lahir)->translatedFormat('F, d Y') : null;
        $user->alamat_stripped = strip_tags($user->alamat);
    
        // Ambil pengguna yang sedang login
        $loggedInUser = auth()->user();
        
        return view('Karyawan.profile', compact('user', 'loggedInUser'));
    }
    

    public function updatekaryawanprofile(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jk' => 'required|in:L,P',
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->no_hp = $validatedData['no_hp'];
        $user->alamat = $validatedData['alamat'];
        $user->tgl_lahir = $validatedData['tgl_lahir'] ?? $user->tgl_lahir;
        $user->jk = $validatedData['jk'];

        if ($request->hasFile('file_foto')) {
            if ($user->file_foto) {
                Storage::delete('public/karyawan/photo-profile/' . $user->file_foto);
            }

            $fileFoto = $request->file('file_foto');
            $fileNameFoto = time() . '_' . $fileFoto->getClientOriginalName();
            $fileFoto->storeAs('public/karyawan/photo-profile', $fileNameFoto);
            $user->file_foto = $fileNameFoto;
        }

        $user->save();

        return redirect()->route('edituserskaryawanprofile', $user->id)->with('success', 'Profile berhasil diperbarui.');
    }
}
