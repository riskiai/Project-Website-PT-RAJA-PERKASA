<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengundurandiri;

class PengunduranDiriKaryawanController extends Controller
{
    public function listpengundurandirikaryawan()
    {
        $data = Pengundurandiri::with('user')->get();
        return view('Hrd.pengundurandiri.list', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pengunduran_diri' => 'required|in:disetujui,tidak_disetujui,belumdicek',
            'file_balasan' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $pengunduranDiri = Pengundurandiri::findOrFail($id);

        $filePath = $pengunduranDiri->file_balasan;
        if ($request->hasFile('file_balasan')) {
            $filePath = $request->file('file_balasan')->store('balasan_files', 'public');
        }

        $pengunduranDiri->update([
            'status_pengunduran_diri' => $request->status_pengunduran_diri,
            'file_balasan' => $filePath
        ]);

        return redirect()->route('listpengundurandirikaryawan')->with('success', 'Status pengunduran diri berhasil diperbarui.');
    }

    public function delete($id)
    {
        $pengunduranDiri = Pengundurandiri::findOrFail($id);
        $pengunduranDiri->delete();

        return redirect()->route('listpengundurandirikaryawan')->with('success', 'Pengajuan pengunduran diri berhasil dihapus.');
    }
}
