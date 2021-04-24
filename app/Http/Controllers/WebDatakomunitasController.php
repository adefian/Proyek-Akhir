<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AnggotaKomunitas;
use App\User;
use App\PimpinanKomunitas;
use File;

class WebDatakomunitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AnggotaKomunitas::all();

        $dataperkomunitas = [];
        if (auth()->user()->role == 'pimpinankomunitas') {
            $pimpinankomunitas = PimpinanKomunitas::where('user_id',auth()->user()->id)->first();
            $komunitas_id = $pimpinankomunitas->komunitas_id;
            $dataperkomunitas = AnggotaKomunitas::where('komunitas_id', $komunitas_id)->get();
        }
        return view('admins.layouts_sidebar.dataanggotakomunitas.index', compact('data', 'dataperkomunitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = AnggotaKomunitas::findOrFail($id);
        $email = User::all()->except($user->user_id);
        $cekemail = $email->where('email', $request->email)->first();

        dd($cekemail);
        if ($cekemail) {
            alert()->error('Email yang digunakan sudah terdaftar', 'Gagal');
            return back();
        } else {
        $komunitas = AnggotaKomunitas::findOrFail($id);

        $input = ([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            ]);
            
        $user = User::findOrFail($komunitas->user_id);

        $input2 = (['email' => $request->email]);

        $komunitas->update($input);
        $user->update($input2);

        alert()->success('Berhasil','Data Berhasil diedit');
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
        $id = AnggotaKomunitas::findOrFail($id);
        File::delete('foto_user/'.$id->file_gambar);
        $id->delete($id);

        alert()->success('Berhasil','Data berhasil dihapus');
        return back();
    }
}
