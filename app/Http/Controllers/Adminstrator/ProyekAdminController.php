<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyekAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.proyek.list');
    }

    public function store()
    {
        return view('Adminstrator.proyek.create');
    }

    public function edit()
    {
        return view('Adminstrator.proyek.edit');
    }
}
