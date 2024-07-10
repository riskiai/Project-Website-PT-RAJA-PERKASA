<?php

namespace App\Http\Controllers\Adminstrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KontakPT;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KontakAdminController extends Controller
{
    public function index(Request $request) {
        $query = KontakPT::latest();

        /* Melakukan Filter Data */
        if ($request->get('search')) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $query->get();

        return view('Adminstrator.kontak.list', compact('data','request'));
    }

    public function create() {
        return view('Adminstrator.kontak.create');
    }

    public function createproses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'alamat' => 'required',
            'links' => 'required|url',
            'status_kontak' => 'required|in:active,nonactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Buat data baru
        KontakPT::create([
            // 'title' => $request->title,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'links' => $request->links,
            'status_kontak' => $request->status_kontak,
            'created_at' => now(),
        ]);

        return redirect()->route('kontaklist');
    }


    public function edit(Request $request, $id)
    {
        $data = KontakPT::find($id);

        if (!$data) {
            return redirect()->route('kontaklist')->with('error', 'Data not found.');
        }

        return view('Adminstrator.kontak.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'alamat' => 'required',
            'links' => 'required|url',
            'status_kontak' => 'required|in:active,nonactive',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        $data = KontakPT::find($id);
    
        if (!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }
    
        // $data->title = $request->title;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->alamat = $request->alamat;
        $data->links = $request->links;
        $data->status_kontak = $request->status_kontak;
    
        $data->save();
    
        return redirect()->route('kontaklist')->with('success', 'Data updated successfully.');
    }

    public function delete(Request $request, $id) {
        $data = KontakPT::find($id);
    
        if($data) {
            // Hapus data dari database
            $data->delete();
        }
    
        return redirect()->route('kontaklist');
    }
    
}
