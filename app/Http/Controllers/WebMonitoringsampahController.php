<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\User;
use App\TempatSampah;
use App\Token;
use App\Agenda;
use File;

class WebMonitoringsampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TempatSampah::orderBy('status', 'DESC')->get();
        return view('admins.layouts_sidebar.monitoring_sampah.indikasi', compact('data'));
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
        $user =  auth()->user()->id;
        
        $input = ([
            'nama' => $request->nama,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id' => $user,
            'status' => 'kosong'
        ]);

        if ($file = $request->file('file_gambar')) {
            $nama = time() .'_'. $file->getClientOriginalName();
            $file->move('assets/img/tempatsampah/', $nama);  
            $input['file_gambar'] = $nama;
        }

        TempatSampah::create($input);

        alert()->success('Selamat','Data berhasil ditambahkan');
        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubahstatus(Request $request, $id)
    {
        $tempatsampah = TempatSampah::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];
        $tempatsampah->update($data);

        alert()->success('Berhasil','Data Berhasil diubah');
        return back();
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
        $tempatsampah = TempatSampah::findOrFail($id);
        
        $user =  auth()->user()->id;
        
        $input = ([
            'nama' => $request->nama,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id' => $user,
        ]);

        if ($file = $request->file('file_gambar')) {
            $nama = time() .'_'. $file->getClientOriginalName();
            $file->move('assets/img/tempatsampah/', $nama);  
            $input['file_gambar'] = $nama;
        }

        $tempatsampah->update($input);
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
        $id = TempatSampah::findOrFail($id);
        File::delete('assets/img/tempatsampah/'.$id->file_gambar);

        $id->delete($id);

        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }

    public function lokasi()
    {
        $data = TempatSampah::orderBy('status', 'DESC')->get();
        return view('admins.layouts_sidebar.monitoring_sampah.lokasi', compact('data'));
    }

}
