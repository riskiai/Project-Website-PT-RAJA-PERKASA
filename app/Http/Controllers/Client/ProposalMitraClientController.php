<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProposalMitraClientController extends Controller
{
    public function index () {
        return view('Client.pengajuankerjasamamitra');
    }

    public function statuskerjasama() {
        return view('Client.statuskerjasamamitra');
    }
}