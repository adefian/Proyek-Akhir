<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\User;
use App\komunitas;
use App\AnggotaKomunitas;

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
                alert()->success('Selamat datang', 'Haloo !!');
                return redirect()->route('pimpinan.index');
            }
            elseif (auth()->user()->role == 'petugaslapangan') {
                alert()->success('Selamat datang','Haloo !!');
                return redirect()->route('petugaslapangan.index');
            }
            elseif (auth()->user()->role == 'komunitas'){
                alert()->success('Selamat datang','Haloo !!');
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
        $data = Komunitas::where('level',1)->get();
        return view ('auths.register', compact('data'));
    }
    public function postregister(Request $request)
    {
        $data = [
            'nama' => $request->username,
            'role' => 'komunitas',
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $lastid = User::create($data)->id;

        $user = new AnggotaKomunitas;
        $user->nama = $request->nama;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->user_id = $lastid;
        $user->komunitas_id = $request->daerah;
        $user->save();

            alert()->success('Selamat Berhasil Membuat Akun', 'Silahkan Login disini');
            return redirect()->route('login');
    }

    public function daftardaerah()
    {
        return view ('auths.daftardaerah');
    }

    public function postdaftardaerah (Request $request)
    {
        $data = [
            'email' => $request->email,
            'daerah' => $request->daerah,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'level' => 0
        ];

        Komunitas::create($data);
        alert()->info('Tunggu Proses Validasi, Akan segera diproses','Berhasil ditambahkan');

        return back();

    }
}
