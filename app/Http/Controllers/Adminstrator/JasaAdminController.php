<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JasaAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.jasa.list');
    }

    public function store()
    {
        return view('Adminstrator.jasa.create');
    }

    public function edit()
    {
        return view('Adminstrator.jasa.edit');
    }
}
