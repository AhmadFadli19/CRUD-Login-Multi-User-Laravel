<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        return view('admin');
    }
    function operator()
    {
        return view('admin');
    }
    function keuangan()
    {
        return view('admin');
    }
    function marketing()
    {
        return view('admin');
    }
    
    
}
