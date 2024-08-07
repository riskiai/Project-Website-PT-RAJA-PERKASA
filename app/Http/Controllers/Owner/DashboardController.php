<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\List_Data_Proyek;
use App\Models\Document_Kerjasama_Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    // Data untuk Chart Proyek Berdasarkan Tahun dan Status Progres
    $currentYear = date('Y');
    $proyekByStatusAndYear = List_Data_Proyek::selectRaw('YEAR(created_at) as year, status_progres_proyek, COUNT(*) as total')
        ->groupBy('year', 'status_progres_proyek')
        ->get()
        ->groupBy('year');

    if (!isset($proyekByStatusAndYear[$currentYear])) {
        $proyekByStatusAndYear[$currentYear] = collect([]);
    }

    // Data Testimoni dengan pagination
    $testimonis = Testimoni::with(['user', 'mitra'])->paginate(3);

    // Data Proyek
    $proyeks = List_Data_Proyek::with(['materials', 'peralatan', 'bidangproyeks'])->get();

    return view('Owner.dashboard.dashboard', compact(
        'totalKaryawan', 
        'totalMitraPerusahaan', 
        'totalProyekSedangBerjalan', 
        'totalProyekSelesai',
        'proyekByStatusAndYear',
        'currentYear',
        'testimonis',
        'proyeks'
    ));
}


    public function editownerProfile($id) {
        $user = User::findOrFail($id);
        $user->tgl_lahir_formatted = $user->tgl_lahir ? Carbon::parse($user->tgl_lahir)->translatedFormat('F, d Y') : null;
        $user->alamat_stripped = strip_tags($user->alamat);

          // Ambil pengguna yang sedang login
          $loggedInUser = auth()->user();

        return view('Owner.profile', compact('user', 'loggedInUser'));
    }

    public function updateownerprofile(Request $request, $id) {
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
                Storage::delete('public/owner/photo-profile/' . $user->file_foto);
            }

            $fileFoto = $request->file('file_foto');
            $fileNameFoto = time() . '_' . $fileFoto->getClientOriginalName();
            $fileFoto->storeAs('public/owner/photo-profile', $fileNameFoto);
            $user->file_foto = $fileNameFoto;
        }

        $user->save();

        return redirect()->route('editusersownerprofile', $user->id)->with('success', 'Profile berhasil diperbarui.');
    }
}
