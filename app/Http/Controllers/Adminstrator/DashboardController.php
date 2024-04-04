<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Adminstrator.dashboard.dahshboard');
    }
}
