<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaksi;
use App\Point;
use App\Masyarakat;


class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Point::all();
        return view ('admins.layouts_sidebar.daftar_pembuang_sampah.index', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tukarcode()
    {
        $masyarakat = Masyarakat::find(1);
        return view('tukarcode', compact('masyarakat'));
    }

    public function pushtukarcode(Request $request)
    {
        $poin = Point::where('kode_reward', $request->kode_reward)->first();

        $data = ([
            'masyarakat_id' => 1,
            'kode_reward' => null ,
        ]);
        
        $poin->update($data);

        $poin_baru = $poin->nilai;
        $masyarakat = Masyarakat::findOrFail(1);
        $poin_lama = $masyarakat->total_poin;
        $total_poin = $poin_baru + $poin_lama;

        // dd($total_poin);

        $masyarakat->update(['total_poin' => $total_poin]);
        alert()->success('Sukses');
        return back();
    }
}
