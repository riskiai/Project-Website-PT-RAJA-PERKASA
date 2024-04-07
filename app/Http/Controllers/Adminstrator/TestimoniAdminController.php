<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimoniAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.testimoni.list');
    }

    public function store()
    {
        return view('Adminstrator.testimoni.create');
    }

    public function edit()
    {
        return view('Adminstrator.testimoni.edit');
    }
}
