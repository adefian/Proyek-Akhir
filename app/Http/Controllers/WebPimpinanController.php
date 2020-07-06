<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Auth;
use App\TempatSampah;
use App\User;
use App\Komunitas;
use App\AnggotaKomunitas;
use App\PimpinanEcoranger;
use App\Agenda;
use App\Point;
use DB;
use Carbon\Carbon;

class WebPimpinanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $user = User::all()->count();
        $komunitas = Komunitas::where('level', 1)->count();
        $tempatsampah = TempatSampah::all()->count();
        $anggotakomunitas = AnggotaKomunitas::all()->count();
        $pimpinan = PimpinanEcoranger::where('user_id', auth()->user()->id)->first();

        $ts = TempatSampah::all();
        $tempat = Arr::pluck($ts ,'nama');

        $b = Point::where('status', 1)->count();
        $s = Point::where('status', 0)->count();

        $nilai = [$b, $s];

        $bln = Carbon::now()->subMonth(1);

        $join = Komunitas::Join('agenda','agenda.komunitas_id','=','komunitas.id')->where('agenda.updated_at', '>',$bln)
                ->select(DB::raw('COUNT(DISTINCT agenda.id) AS a'),'komunitas.daerah')
                ->groupBy('komunitas.daerah')->orderBy('a','desc')->get();

        
        // return $join;


        return view ('admins.pimpinan.index2',compact('tempatsampah','user','komunitas','anggotakomunitas', 'tempat', 'nilai','pimpinan', 'join'));
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

        $pimpinan = PimpinanEcoranger::where('user_id', $id)->first();
        
        return view('admins.pimpinan.profile', compact('pimpinan'));
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
        $user = PimpinanEcoranger::findOrFail($id);
        $email = User::all()->except($user->user_id);
        $cekemail = $email->where('email', $request->email)->first();

        if ($cekemail) {
            alert()->error('Email yang digunakan sudah terdaftar', 'Gagal');
            return back();
        } else {
        $pimpinan = PimpinanEcoranger::findOrFail($id);
        $input = ([
            'nama' => $request->namalengkap,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'bio' => $request->bio,
        ]);

        if ($file = $request->file('file_gambar')) {
            $nama = time() . $file->getClientOriginalName();
            $file->move('assets/img/avatar/', $nama);  
            $input['file_gambar'] = $nama;
        }

        $ed = $pimpinan->user_id;
        $user = User::findOrFail($ed);
        $input2 = ([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $pass = bcrypt($request->password);
            $input2['password'] = $pass;
        }

        
        $pimpinan->update($input);
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
