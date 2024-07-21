<?php

namespace App\Http\Controllers\Hrd;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Role;
use App\Models\User;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use App\Models\Pengundurandiri;
use App\Models\List_Data_Proyek;
use App\Http\Controllers\Controller;
use App\Models\ListPeringatanKaryawan;
use Illuminate\Support\Facades\Storage;
use App\Models\Document_Kerjasama_Client;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Total Karyawan
        $totalKaryawan = User::whereHas('role', function($query) {
            $query->where('role_name', 'karyawan');
        })->count();

        // Total Mitra Perusahaan
        $totalMitraPerusahaan = Document_Kerjasama_Client::where('status_kerjasama', 'diterima')->count();

        // Total Proyek Sedang Berjalan
        $totalProyekSedangBerjalan = List_Data_Proyek::where('status_progres_proyek', 'sedangberjalan')->count();

        // Total Proyek Selesai
        $totalProyekSelesai = List_Data_Proyek::where('status_progres_proyek', 'selesai')->count();

        // Data Kehadiran Keseluruhan
        $totalKehadiranKeseluruhan = AbsenKaryawan::where('status_absensi', 'hadir')->count();

        // Data Ketidakhadiran Keseluruhan
        $totalKetidakhadiranKeseluruhan = AbsenKaryawan::where('status_absensi', 'tidak_hadir')->count();

        // Data Cuti
        $totalCuti = Cuti::where('status_cuti', 'disetujui')->count();

        // Data Pengunduran Diri
        $totalPengundurandiri = Pengundurandiri::where('status_pengunduran_diri', 'disetujui')->count();

        // Function to format status_absensi values
        function formatStatusAbsensi($status) {
            $formatted = str_replace('_', ' ', $status);
            return ucwords($formatted);
        }

        // Data Kehadiran dan Ketidakhadiran per Bulan
        $currentMonth = date('Y-m');
        $kehadiranByMonth = AbsenKaryawan::selectRaw('DATE_FORMAT(tanggal_absen, "%Y-%m") as month, status_absensi, COUNT(*) as total')
            ->groupBy('month', 'status_absensi')
            ->get()
            ->groupBy('month')
            ->map(function ($monthData) {
                return $monthData->map(function ($data) {
                    $data->status_absensi = formatStatusAbsensi($data->status_absensi);
                    return $data;
                });
            });

        if (!isset($kehadiranByMonth[$currentMonth])) {
            $kehadiranByMonth[$currentMonth] = collect([]);
        }

        // Data Cuti per Karyawan
        $cutiKaryawan = Cuti::with('user')
            ->selectRaw('user_id, COUNT(*) as total_cuti, status_cuti')
            ->groupBy('user_id', 'status_cuti')
            ->get();

        // Data Peringatan Karyawan
        $peringatanKaryawan = ListPeringatanKaryawan::with('user')
            ->selectRaw('user_id, jenis_peringatan, status_karyawan, COUNT(*) as total_peringatan')
            ->groupBy('user_id', 'jenis_peringatan', 'status_karyawan')
            ->get();

        // Data Testimoni dengan pagination
        $testimonis = Testimoni::with(['user', 'mitra'])->paginate(3);

        // Data Proyek
        $proyeks = List_Data_Proyek::with(['materials', 'peralatan'])->get();

        return view('Hrd.dashboard.dashboard', compact(
            'totalKaryawan', 
            'totalMitraPerusahaan', 
            'totalProyekSedangBerjalan', 
            'totalProyekSelesai',
            'totalKehadiranKeseluruhan',
            'totalKetidakhadiranKeseluruhan',
            'totalCuti',
            'totalPengundurandiri',
            'kehadiranByMonth',
            'currentMonth',
            'cutiKaryawan',
            'peringatanKaryawan',
            'testimonis',
            'proyeks'
        ));
    }

    public function edithrdProfile($id) {
        $user = User::findOrFail($id);
        $user->tgl_lahir_formatted = $user->tgl_lahir ? Carbon::parse($user->tgl_lahir)->translatedFormat('F, d Y') : null;
        $user->alamat_stripped = strip_tags($user->alamat);

         // Ambil pengguna yang sedang login
         $loggedInUser = auth()->user();

        return view('Hrd.profile', compact('user', 'loggedInUser'));
    }

    public function updatehrdprofile(Request $request, $id) {
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
                Storage::delete('public/hrd/photo-profile/' . $user->file_foto);
            }

            $fileFoto = $request->file('file_foto');
            $fileNameFoto = time() . '_' . $fileFoto->getClientOriginalName();
            $fileFoto->storeAs('public/hrd/photo-profile', $fileNameFoto);
            $user->file_foto = $fileNameFoto;
        }

        $user->save();

        return redirect()->route('editusershrdprofile', $user->id)->with('success', 'Profile berhasil diperbarui.');
    }
}
