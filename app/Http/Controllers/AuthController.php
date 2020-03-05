<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            
            if(auth()->user()->id_role == 1){
                return redirect()->route('pimpinan.index');
            }
            elseif (auth()->user()->id_role == 2) {
                return redirect()->route('petugaslapangan.index');
            }
            elseif (auth()->user()->id_role == 3){
                return redirect()->route('komunitas.index');
            }
        }
        // Alert::error('Akun Tidak Ada');
        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        // ALert::success('Berhasil Logout');
        return redirect()->route('login');
    }

    public function register()
    {
        return view ('auths.register');
    }

    public function daftarwilayah()
    {
        return view ('auths.daftarwilayah');
    }
}
