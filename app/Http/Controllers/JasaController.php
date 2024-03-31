<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index(){
        return view('Pengunjung.jasa');
    }
}
