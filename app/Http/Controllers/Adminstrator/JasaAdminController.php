<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\Jasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JasaAdminController extends Controller
{
    public function index(Request $request) {
        $query = Jasa::latest();

        /* Melakukan Filter Data */
        if ($request->get('search')) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $query->get();

        return view('Adminstrator.jasa.list', compact('data','request'));
    }

    public function create() {
        return view('Adminstrator.jasa.create');
    }

    public function createproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jasa' => 'required',
            'short_description' => 'required',
            'detail_description' => 'required',
            'status_jasa' => 'required',
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
                $path = $file->storeAs('public/photo-jasa', $filename); // Simpan gambar ke dalam storage
                $images[] = $filename; // Kumpulkan nama file
            }
        }

        // Buat data baru
        Jasa::create([
            'nama_jasa' => $request->title,
            'short_description' => $request->short_description,
            'detail_description' => $request->detail_description,
            'status_jasa' => $request->status_jasa,
            'image' => implode(',', $images), // Simpan string nama file gambar
        ]);

        return redirect()->route('jasalist');
    }


    public function edit(Request $request, $id)
    {
        $data = Jasa::find($id);

        return view('Adminstrator.jasa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_jasa' => 'required',
            'short_description' => 'required',
            'detail_description' => 'required',
            'status_jasa' => 'required',
            'image.*' => 'sometimes|mimes:png,jpg,jpeg|max:2048', // 'image.*' untuk menangani multiple gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = Jasa::find($id);

        if ($data) {
            $data->nama_jasa = $request->nama_jasa;
            $data->short_description = $request->short_description;
            $data->detail_description = $request->detail_description;
            $data->status_jasa = $request->status_jasa;

            // Update gambar jika ada yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar yang lama
                Storage::delete(explode(',', $data->image));
                
                // Simpan gambar yang baru
                $images = [];
                foreach ($request->file('image') as $file) {
                    $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/photo-jasa', $filename); // Simpan gambar ke dalam storage
                    $images[] = $filename; // Kumpulkan nama file
                }
                $data->image = implode(',', $images);
            }

            $data->save();

            return redirect()->route('jasalist')->with('success', 'Data updated successfully.');
        }

        return redirect()->back()->with('error', 'Data not found.');
    }

    public function delete(Request $request, $id){
        $data = Jasa::find($id);
    
        if($data){
            // Hapus gambar dari penyimpanan
            if (!empty($data->image)) {
                $images = explode(',', $data->image);
                foreach ($images as $image) {
                    Storage::delete('public/photo-jasa/' . $image);
                }
            }
            
            // Hapus data dari database
            $data->delete();
        }
    
        return redirect()->route('jasalist');
    }
    
}
