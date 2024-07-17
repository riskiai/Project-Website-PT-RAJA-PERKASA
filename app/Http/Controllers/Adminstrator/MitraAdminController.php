<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\Mitra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraAdminController extends Controller
{
    public function index(Request $request) {
        $query = Mitra::query()
            ->whereHas('users', function($query) {
                $query->where('status_pic_perusahaan', 'client')
                      ->whereHas('documentKerjasamaClient', function($query) {
                          $query->where('status_kerjasama', 'diterima');
                      });
            })
            ->latest();

        /* Melakukan Filter Data */
        if ($request->get('search')) {
            $query->where('name_mitra', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $query->get();

        return view('Adminstrator.mitra.list', compact('data', 'request'));
    }

    public function create() {
        return view('Adminstrator.mitra.create');
    }

    public function createproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_mitra' => 'required',
            'status_mitra' => 'required',
            'image.*' => 'required|mimes:png,jpg,jpeg|max:2048', // 'image.*' untuk menangani multiple gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Simpan gambar
        $images = [];
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/photo-mitra', $filename); // Simpan gambar ke dalam storage
                $images[] = $filename; // Kumpulkan nama file
            }
        }

        // Buat data baru
        Mitra::create([
            'name_mitra' => $request->name_mitra,
            'status_mitra' => $request->status_mitra,
            'image' => implode(',', $images), // Simpan string nama file gambar
        ]);

        return redirect()->route('mitralist');
    }

    public function edit(Request $request, $id)
    {
        $data = Mitra::find($id);

        return view('Adminstrator.mitra.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_mitra' => 'required',
            'status_mitra' => 'required',
            'image.*' => 'sometimes|mimes:png,jpg,jpeg|max:2048', // 'image.*' untuk menangani multiple gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = Mitra::find($id);

        if ($data) {
            $data->name_mitra = $request->name_mitra;
            $data->status_mitra = $request->status_mitra;

            // Update gambar jika ada yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar yang lama
                Storage::delete(explode(',', $data->image));

                // Simpan gambar yang baru
                $images = [];
                foreach ($request->file('image') as $file) {
                    $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/photo-mitra', $filename); // Simpan gambar ke dalam storage
                    $images[] = $filename; // Kumpulkan nama file
                }
                $data->image = implode(',', $images);
            }

            $data->save();

            return redirect()->route('mitralist')->with('success', 'Data updated successfully.');
        }

        return redirect()->back()->with('error', 'Data not found.');
    }


    public function delete(Request $request, $id)
    {
        $data = Mitra::find($id);
        
        if($data) {
            // Hapus gambar dari penyimpanan
            if (!empty($data->image)) {
                $images = explode(',', $data->image);
                foreach ($images as $image) {
                    Storage::delete('public/photo-mitra/' . $image);
                }
            }

            // Set mitra_id menjadi NULL di tabel users yang terkait
            $data->users()->update(['mitra_id' => null]);

            // Set mitra_id menjadi NULL di tabel testimonis yang terkait
            $data->testimonis()->update(['mitra_id' => null]);

            // Hapus data dari database
            $data->delete();
        }

        return redirect()->route('mitralist')->with('success', 'Data Deleted successfully.');
    }

    
}
