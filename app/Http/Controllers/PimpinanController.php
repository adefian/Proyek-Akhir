<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\TempatSampah;
use App\User;
use App\Komunitas;
use App\AnggotaKomunitas;
use App\PimpinanEcoranger;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $user = User::all()->count();
        $komunitas = Komunitas::all()->count();
        $tempatsampah = TempatSampah::all()->count();
        $anggotakomunitas = AnggotaKomunitas::all()->count();
        return view ('admins.pimpinan.index',compact('tempatsampah','user','komunitas','anggotakomunitas'));
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
        $user = Auth::user();

        $data = PimpinanEcoranger::where('user_id', $id)->first();
        
        return view('admins.pimpinan.profile', compact('data','password'));
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
        // fetching the user model 
        $user = Auth::user();

        $pimpinan = PimpinanEcoranger::findOrFail($id);
        $input = ([
            'nama' => $request->namalengkap,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'bio' => $request->bio,
        ]);

        if ($file = $request->file('foto')) {
            $nama = time() . $file->getClientOriginalName();
            $file->move('assets/img/avatar/', $nama);  
            $input['foto'] = $nama;
        }

        $ed = $pimpinan->user_id;
        $user = User::findOrFail($ed);
        $input2 = ([
            'nama' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $pass = bcrypt($request->password);
            $input2['password'] = $pass;
        }

        
        $pimpinan->update($input);
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
        //
    }
}
