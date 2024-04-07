<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TentangAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.tentangpt.list');
    }

    public function store()
    {
        return view('Adminstrator.tentangpt.create');
    }

    public function edit()
    {
        return view('Adminstrator.tentangpt.edit');
    }
}
