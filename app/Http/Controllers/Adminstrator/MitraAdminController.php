<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MitraAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.mitra.list');
    }

    public function store()
    {
        return view('Adminstrator.mitra.create');
    }

    public function edit()
    {
        return view('Adminstrator.mitra.edit');
    }
}
