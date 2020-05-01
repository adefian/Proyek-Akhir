<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komunitas;

class MonitoringkomunitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Komunitas::where('level', 1)->get();
        return view('admins.layouts_sidebar.monitoring_komunitas.daftar_komunitas', compact('data'));
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
        
        $input = ([
            'daerah' => $request->daerah,
            'email' => auth()->user()->email,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'level' => 1
        ]);

        Komunitas::create($input);

        alert()->success('Selamat','Data berhasil ditambahkan');
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
        $komunitas = Komunitas::findOrFail($id);
        
        $input = ([
            'daerah' => $request->daerah,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $komunitas->update($input);
        alert()->success('Berhasil','Data Berhasil diedit');
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
        $id = Komunitas::findOrFail($id);

        $id->delete($id);

        alert()->success('Berhasil','Data berhasil dihapus');
        return back();
    }

    public function validasi()
    {
        $data = Komunitas::where('level', 0)->get();
        return view('admins.layouts_sidebar.monitoring_komunitas.validasi', compact('data'));
    }

    public function editvalidasi(Request $request, $id)
    {
        $komunitas = Komunitas::findOrFail($id);
        
        $input = ([
            'level' => $request->level
        ]);

        $komunitas->update($input);
        alert()->success('Berhasil validasi data', 'telah tervalidasi');
        return redirect('daftarkomunitas');
    }

    public function hapusvalidasi($id)
    {
        $id = Komunitas::findOrFail($id);
        $id->delete();

        alert()->success('Berhasil','Data Berhasil dihapus');
        return back();
    }
}
