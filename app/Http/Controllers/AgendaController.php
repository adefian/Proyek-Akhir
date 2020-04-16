<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\User;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Agenda::all();
        // $data2 = Agenda::only('user_id');
        // $data->load('petugasygmenambahkan:id,nama');
        // return response()->json(['data' => $data]);
        return view('admins.layouts_sidebar.monitoring_komunitas.kelola_agenda', compact('data'));
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
        $user = auth()->user()->id;
        $input = ([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'jenis_agenda' => $request->jenis_agenda,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
        ]);
        Agenda::create($input);

        alert()->success('Data berhasil ditambahkan','Selamat');
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
        $agenda = Agenda::findOrFail($id);
        
        $user =  auth()->user()->id;
        
        $input = ([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'jenis_agenda' => $request->jenis_agenda,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
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
        $agenda = Agenda::find($id);

        $agenda->delete($id);
        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }
}
