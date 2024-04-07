<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontakAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.kontak.list');
    }

    public function store()
    {
        return view('Adminstrator.kontak.create');
    }

    public function edit()
    {
        return view('Adminstrator.kontak.edit');
    }
}
