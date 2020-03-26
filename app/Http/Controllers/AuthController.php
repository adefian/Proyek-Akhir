<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            
            if(auth()->user()->role == 'pimpinanecoranger'){
                alert()->success('Selamat datang','Berhasil');
                return redirect()->route('pimpinan.index');
            }
            elseif (auth()->user()->role == 'petugaslapangan') {
                alert()->success('Selamat datang','Berhasil');
                return redirect()->route('petugaslapangan.index');
            }
            elseif (auth()->user()->role == 'komunitas'){
                alert()->success('Selamat datang','Berhasil');
                return redirect()->route('komunitas.index');
            }
        }
        alert()->error('Akun tidak ditemukan','Gagal');
        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        alert()->success('Kamu berhasil keluar', 'Selamat tinggal!');
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
