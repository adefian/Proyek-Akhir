<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ecobrick;

class EcobrickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ecobrick::all();

        return view('admins.layouts_sidebar.saran_ecobrick.reviewsaran', compact('data'));
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
        $input = [
            'keterangan' => $request->keterangan,
            'level' => 1,
            'user_id' => auth()->user()->id
        ];

        if ($file = $request->file('foto_diaplikasikan')) {
            $nama = time() .'_'. $file->getClientOriginalName();
            $file->move('assets/img/ecobrick/', $nama);  
            $input['foto_diaplikasikan'] = $nama;
        }

        Ecobrick::create($input);
        alert()->success('Data Berhasil ditambahkan','Selamat');
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
        $agenda = Ecobrick::findOrFail($id);
        
        $user =  auth()->user()->id;
        
        $input = ([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'user_id' => $user,
            'tanggal' => $request->tanggal
        ]);
        
        $agenda->update($input);
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
        $agenda = Ecobrick::find($id);

        $agenda->delete($id);
        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }

    public function ecobrick()
    {
        return view ('home.ecobrick');
    }

    public function TambahSaran(Request $request)
    {
        $input = [
            'nama_pengirimsaran' => $request->nama_pengirimsaran,
            'keterangan' => $request->keterangan
        ];

        if ($file = $request->file('foto_diusulkan')) {
            $nama = time() .'_'. $file->getClientOriginalName();
            $file->move('assets/img/ecobrick/', $nama);  
            $input['foto_diusulkan'] = $nama;
        }

        Ecobrick::create($input);
        alert()->success('Berhasil mengirim saran','Saran akan segera diperiksa');
        return back();
    }
}
