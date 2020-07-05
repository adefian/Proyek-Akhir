<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PetugasLapangan;
use App\Komunitas;
use App\PimpinanEcoranger;
use App\User;

class WebDatapetugaslapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PetugasLapangan::all();
        $komunitas = Komunitas::where('level', 1)->get();
        return view('admins.layouts_sidebar.datapetugaslapangan.index', compact('data','komunitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekemail = User::where('email', $request->email)->first();

        if ($cekemail) {
            if ($request->wilayah == null) {
                alert()->error('Email yang digunakan sudah terdaftar dan Pilihan Komunitas tidak boleh kosong', 'Gagal')->persistent('Close');
                return back();
            } else {
            alert()->error('Email yang digunakan sudah terdaftar', 'Gagal')->persistent('Close');
            return back();
            }   
        } elseif ($request->wilayah == null) {
            alert()->error('Pilihan Komunitas tidak boleh kosong', 'Gagal')->persistent('Close');
            return back();
        } else {
        $akun = ([
            'username' => $request->nama,
            'role' => 'petugaslapangan',
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);
        $lastid = User::create($akun)->id;

        $p = PimpinanEcoranger::where('user_id', auth()->user()->id)->first();
            $user = new PetugasLapangan;
            $user->nama = $request->nama;
            $user->nohp = $request->nohp;
            $user->alamat = $request->alamat;
            $user->wilayah = $request->wilayah;
            $user->pimpinan_ecoranger_id = $p->id;
            $user->user_id = $lastid;
            $user->save();

            alert()->success('Dengan Password : password','Berhasil menambahkan');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        $user = PetugasLapangan::findOrFail($id);
        $email = User::all()->except($user->user_id);
        $cekemail = $email->where('email', $request->email)->first();

        if ($cekemail) {
            alert()->error('Email yang digunakan sudah terdaftar', 'Gagal');
            return back();
        } else {
        $petugaslap = PetugasLapangan::findOrFail($id);
        $p = PimpinanEcoranger::where('user_id', auth()->user()->id)->first();
        $input = ([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'pimpinan_ecoranger_id' => $p->id
            ]);
        if ($request->wilayah) {
            $input['wilayah']=$request->wilayah;
        }
            
        $id = $petugaslap->user_id;
        $user = User::findOrFail($id);
        $input2 = ([
            'username' => $request->username,
            'email' => $request->email,
        ]);
        
        $petugaslap->update($input);
        $user->update($input2);

        alert()->success('Berhasil','Data berhasil diedit');
        return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = PetugasLapangan::find($id);
        $user_id = $id->user_id;
        $user = User::find($user_id);

        $user->delete($user);
        $id->delete($id);

        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }
}
