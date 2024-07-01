<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimoniAdminController extends Controller
{
    public function index(Request $request) {
        $query = Testimoni::with(['user', 'mitra'])->latest();

        // Filtering data
        if ($request->get('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->get('search') . '%');
            });
        }

        $data = $query->get();

        return view('Adminstrator.testimoni.list', compact('data', 'request'));
    }

    public function create() {
        // Ambil semua mitra dan pengguna dengan role client
        $mitras = Mitra::all();
        $clients = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })->get();

        return view('Adminstrator.testimoni.create', compact('mitras', 'clients'));
    }

    public function createproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'mitra_id' => 'required|exists:mitras,id',
            'position' => 'required',
            'comment' => 'required',
            'status_testimoni' => 'required',
            'image.*' => 'required|mimes:png,jpg,jpeg|max:2048', // 'image.*' for multiple images
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Save images
        $images = [];
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/photo-testimoni', $filename); // Save image to storage
                $images[] = $filename; // Collect file names
            }
        }

        // Create new data
        Testimoni::create([
            'user_id' => $request->user_id,
            'mitra_id' => $request->mitra_id,
            'position' => $request->position,
            'comment' => $request->comment,
            'status_testimoni' => $request->status_testimoni,
            'image' => implode(',', $images), // Save image file names as a string
        ]);

        return redirect()->route('testimonilist')->with('success', 'Testimoni created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $data = Testimoni::find($id);
        $mitras = Mitra::all();
        $clients = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })->get();

        if(!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        return view('Adminstrator.testimoni.edit', compact('data', 'mitras', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'mitra_id' => 'required|exists:mitras,id',
            'position' => 'required',
            'comment' => 'required',
            'status_testimoni' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg|max:2048',// 'image.*' untuk menangani multiple gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = Testimoni::find($id);

        if ($data) {
            $data->user_id = $request->user_id;
            $data->mitra_id = $request->mitra_id;
            $data->position = $request->position;
            $data->comment = $request->comment;
            $data->status_testimoni = $request->status_testimoni;

            // Update gambar jika ada yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar yang lama
                if (!empty($data->image)) {
                    $oldImages = explode(',', $data->image);
                    foreach ($oldImages as $oldImage) {
                        Storage::delete('public/photo-testimoni/' . $oldImage);
                    }
                }
                
                // Simpan gambar yang baru
                $images = [];
                foreach ($request->file('image') as $file) {
                    $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/photo-testimoni', $filename); // Simpan gambar ke dalam storage
                    $images[] = $filename; // Kumpulkan nama file
                }
                $data->image = implode(',', $images);
            }

            $data->save();

            return redirect()->route('testimonilist')->with('success', 'Data updated successfully.');
        }

        return redirect()->back()->with('error', 'Data not found.');
    }

    public function delete(Request $request, $id){
        $data = Testimoni::find($id);
    
        if($data){
            // Hapus gambar dari penyimpanan
            if (!empty($data->image)) {
                $images = explode(',', $data->image);
                foreach ($images as $image) {
                    Storage::delete('public/photo-testimoni/' . $image);
                }
            }
            
            // Hapus data dari database
            $data->delete();
        }
    
        return redirect()->route('testimonilist')->with('success', 'Data deleted successfully.');
    }
}
