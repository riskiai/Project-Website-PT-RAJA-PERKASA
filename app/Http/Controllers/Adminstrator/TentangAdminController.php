<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\TentangPT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TentangAdminController extends Controller
{
    public function index(Request $request) {
        $query = TentangPT::latest();

        /* Melakukan Filter Data */
        if ($request->get('search')) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $query->get();

        return view('Adminstrator.tentangpt.list', compact('data','request'));
    }

    public function create() {
        return view('Adminstrator.tentangpt.create');
    }

    public function createproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required',
            'short_description' => 'required',
            'detail_description' => 'required',
            'status_tentang' => 'required',
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
                $path = $file->storeAs('public/photo-tentangpt', $filename); // Simpan gambar ke dalam storage
                $images[] = $filename; // Kumpulkan nama file
            }
        }

        // Buat data baru
        TentangPT::create([
            // 'title' => $request->title,
            'short_description' => $request->short_description,
            'detail_description' => $request->detail_description,
            'status_tentang' => $request->status_tentang,
            'image' => implode(',', $images), // Simpan string nama file gambar
        ]);

        return redirect()->route('tentanglist');
    }


    public function edit(Request $request, $id)
    {
        $data = TentangPT::find($id);

        return view('Adminstrator.tentangpt.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required',
            'short_description' => 'required',
            'detail_description' => 'required',
            'status_tentang' => 'required',
            'image.*' => 'sometimes|mimes:png,jpg,jpeg|max:2048', // 'image.*' untuk menangani multiple gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = TentangPT::find($id);

        if ($data) {
            // $data->title = $request->title;
            $data->short_description = $request->short_description;
            $data->detail_description = $request->detail_description;
            $data->status_tentang = $request->status_tentang;

            // Update gambar jika ada yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar yang lama
                Storage::delete(explode(',', $data->image));
                
                // Simpan gambar yang baru
                $images = [];
                foreach ($request->file('image') as $file) {
                    $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/photo-tentangpt', $filename); // Simpan gambar ke dalam storage
                    $images[] = $filename; // Kumpulkan nama file
                }
                $data->image = implode(',', $images);
            }

            $data->save();

            return redirect()->route('tentanglist')->with('success', 'Data updated successfully.');
        }

        return redirect()->back()->with('error', 'Data not found.');
    }

    public function delete(Request $request, $id){
        $data = TentangPT::find($id);
    
        if($data){
            // Hapus gambar dari penyimpanan
            if (!empty($data->image)) {
                $images = explode(',', $data->image);
                foreach ($images as $image) {
                    Storage::delete('public/photo-tentangpt/' . $image);
                }
            }
            
            // Hapus data dari database
            $data->delete();
        }
    
        return redirect()->route('tentanglist');
    }
}
