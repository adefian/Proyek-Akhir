<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komunitas;
use App\User;
use App\TempatSampah;
use App\AnggotaKomunitas;
use App\Agenda;
use App\Ecobrick;

class KomunitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $komunitas = Komunitas::all()->count();
        $tempatsampah = TempatSampah::all()->count();
        
        $namakomunitas = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
        $komunitas_id = $namakomunitas->komunitas_id;
        
        $anggotakomunitas = AnggotaKomunitas::where('komunitas_id', $komunitas_id)->count();
        
        $agenda = Agenda::where('komunitas_id', $komunitas_id)->count();

        $ecobrick = Ecobrick::all()->count();

        return view ('admins.komunitas.index',compact('tempatsampah','komunitas','anggotakomunitas','namakomunitas','agenda','ecobrick'));
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
}
