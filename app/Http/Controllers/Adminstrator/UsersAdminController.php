<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersAdminController extends Controller
{
    public function index() {
        return view('Adminstrator.users.list');
    }

    public function store()
    {
        return view('Adminstrator.users.create');
    }

    public function edit()
    {
        return view('Adminstrator.users.edit');
    }
}
