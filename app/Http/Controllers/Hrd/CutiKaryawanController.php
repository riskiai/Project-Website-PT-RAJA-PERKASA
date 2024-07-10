<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiKaryawanController extends Controller
{
    public function listcutikaryawan()
    {
        $data = Cuti::with('user')->get();
        return view('Hrd.cuti.list', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_cuti' => 'required|in:disetujui,tidak_disetujui,belumdicek',
            'file_balasan' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $cuti = Cuti::findOrFail($id);

        $filePath = $cuti->file_balasan;
        if ($request->hasFile('file_balasan')) {
            $filePath = $request->file('file_balasan')->store('balasan_files', 'public');
        }

        $cuti->update([
            'status_cuti' => $request->status_cuti,
            'file_balasan' => $filePath
        ]);

        return redirect()->route('listcutikaryawan')->with('success', 'Status cuti berhasil diperbarui.');
    }

    public function delete($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->delete();

        return redirect()->route('listcutikaryawan')->with('success', 'Pengajuan cuti berhasil dihapus.');
    }
}
