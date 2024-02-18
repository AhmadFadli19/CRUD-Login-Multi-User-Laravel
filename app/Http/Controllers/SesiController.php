<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ],[
            'email.required'=>'Email wajib di isi',
            'password.required'=>'Password wajib di isi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            if(auth::user()->role == 'operator') {
                return redirect('admin/operator');
            }elseif(auth::user()->role == 'keuangan') {
                return redirect('admin/keuangan');
            }elseif(auth::user()->role == 'marketing') {
                return redirect('admin/marketing');
            };
        }else{
            return redirect('')->withErrors('Username dan password yang di masukkan tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
