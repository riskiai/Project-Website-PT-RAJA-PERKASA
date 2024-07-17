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
        $mitras = Mitra::whereHas('users', function($query) {
            $query->where('status_pic_perusahaan', 'client');
        })->get();
        
        $clients = User::where('status_pic_perusahaan', 'client')->whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })->get();

        return view('Adminstrator.testimoni.create', compact('mitras', 'clients'));
    }

    public function createproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id|required_without:new_user_name',
            'new_user_name' => 'nullable|required_without:user_id|string|max:255',
            'mitra_id' => 'required|exists:mitras,id',
            'position' => 'required|string|max:255',
            'comment' => 'required|string',
            'status_testimoni' => 'required|in:active,nonactive',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048', // Hanya satu gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $userId = $request->user_id;

        // Save image
        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/photo-testimoni', $filename); // Save image to storage
        }

        // Create new data
        Testimoni::create([
            'user_id' => $userId,
            'new_user_name' => $request->new_user_name,
            'mitra_id' => $request->mitra_id,
            'position' => $request->position,
            'comment' => $request->comment,
            'status_testimoni' => $request->status_testimoni,
            'image' => $filename, // Save image file name as a string
        ]);

        return redirect()->route('testimonilist')->with('success', 'Testimoni created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $data = Testimoni::find($id);
        $mitras = Mitra::whereHas('users', function($query) {
            $query->where('status_pic_perusahaan', 'client');
        })->get();
        
        $clients = User::where('status_pic_perusahaan', 'client')->whereHas('role', function($query) {
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
            'user_id' => 'nullable|exists:users,id|required_without:new_user_name',
            'new_user_name' => 'nullable|required_without:user_id|string|max:255',
            'mitra_id' => 'required|exists:mitras,id',
            'position' => 'required|string|max:255',
            'comment' => 'required|string',
            'status_testimoni' => 'required|in:active,nonactive',
            'image' => 'mimes:png,jpg,jpeg|max:2048', // Hanya satu gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = Testimoni::find($id);

        if ($data) {
            $data->user_id = $request->user_id;
            $data->new_user_name = $request->new_user_name;
            $data->mitra_id = $request->mitra_id;
            $data->position = $request->position;
            $data->comment = $request->comment;
            $data->status_testimoni = $request->status_testimoni;

            // Update gambar jika ada yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar yang lama
                if (!empty($data->image)) {
                    Storage::delete('public/photo-testimoni/' . $data->image);
                }
                
                // Simpan gambar yang baru
                $file = $request->file('image');
                $filename = date('Y-m-d') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/photo-testimoni', $filename); // Simpan gambar ke dalam storage
                $data->image = $filename;
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
                Storage::delete('public/photo-testimoni/' . $data->image);
            }
            
            // Hapus data dari database
            $data->delete();
        }
    
        return redirect()->route('testimonilist')->with('success', 'Data deleted successfully.');
    }
}
