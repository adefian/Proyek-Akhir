<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PetugasLapangan;
use App\Komunitas;
use App\User;

class DatapetugaslapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PetugasLapangan::all();
        $komunitas = Komunitas::all();
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
    $akun = ([
        'nama' => $request->nama,
        'role' => 'petugaslapangan',
        'email' => $request->email,
        'password' => bcrypt('password')
    ]);
    $lastid = User::create($akun)->id;

        $user = new PetugasLapangan;
        $user->nama = $request->nama;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->wilayah = $request->wilayah;
        $user->pimpinan_ecoranger_id = auth()->user()->id;
        $user->user_id = $lastid;
        dd($user);
        $user->save();

            alert()->success('Selamat','Berhasil menambahkan');
            return back();
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
        $petugaslap = PetugasLapangan::findOrFail($id);
        $input = ([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'wilayah' => $request->wilayah,
            'pimpinan_ecoranger_id' => auth()->user()->id
        ]);

        $id = $petugaslap->user_id;
        $user = User::findOrFail($id);
        $input2 = ([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);
        
        $petugaslap->update($input);
        $user->update($input2);

        alert()->success('Berhasil','Data berhasil diedit');
        return back();
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
        $id_user = $id->id_user;
        $user = User::find($id_user);

        $user->delete($user);
        $id->delete($id);

        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }
}
