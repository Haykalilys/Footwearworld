<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardColntroller extends Controller
{
    public function index(){
        return view('dashboard');
    }
}
