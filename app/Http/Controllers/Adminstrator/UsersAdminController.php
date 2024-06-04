<?php

namespace App\Http\Controllers\Adminstrator;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.users.list');
    }

    public function getclient() {
        // Ambil data pengguna dengan role 'client' saja
        $data = User::whereHas('role', function($query) {
            $query->where('role_name', 'client');
        })->select('name', 'email', 'no_hp', 'file_foto', 'file_ktp', 'status_user')->get();

    
        return view('Adminstrator.users.client', compact('data'));
    }
}
