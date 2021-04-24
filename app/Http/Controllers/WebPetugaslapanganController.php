<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Komunitas;
use App\User;
use App\TempatSampah;
use App\AnggotaKomunitas;
use App\Agenda;
use App\Ecobrick;
use App\PetugasLapangan;
use App\Point;

class WebPetugaslapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = PetugasLapangan::where('user_id',auth()->user()->id)->first();
        $petugaslapangan = PetugasLapangan::all()->count();
        $sampahpenuh = TempatSampah::where('status',1)->count();
        $tempatsampah = TempatSampah::all()->count();
        $sampah = Point::all()->count();

        return view ('admins.petugas_lapangan.index', compact('tempatsampah','petugaslapangan','sampah','sampahpenuh','data'));
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

        $petugaslapangan = PetugasLapangan::where('user_id', $id)->first();
        
        return view('admins.petugas_lapangan.profile', compact('petugaslapangan'));
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
        $petugas_lapangan = PetugasLapangan::findOrFail($id);
        $input = ([
            'nama' => $request->namalengkap,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'bio' => $request->bio,
        ]);

        if ($file = $request->file('file_gambar')) {
            $nama = time() . ".jpeg";
            $file->move('foto_user/', $nama);  
            $input['file_gambar'] = $nama;
        }

        $ed = $petugas_lapangan->user_id;
        $user = User::findOrFail($ed);
        $input2 = ([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $pass = bcrypt($request->password);
            $input2['password'] = $pass;
        }

        
        $petugas_lapangan->update($input);
        $user->update($input2);

        alert()->success('Berhasil','Berhasil merubah profile anda');
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
        //
    }
}
