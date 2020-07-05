<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\User;
use App\TempatSampah;
use App\Token;
use App\Agenda;

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

        $id->delete($id);

        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }

    public function lokasi()
    {
        $data = TempatSampah::orderBy('status', 'DESC')->get();
        return view('admins.layouts_sidebar.monitoring_sampah.lokasi', compact('data'));
    }

    public function PushNotifSampah()
	{
			
    	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $tok = User::all(); //ambil data user
        // $tok = Token::all()->except(3,4); //ambil data user

        $notif = Agenda::where('jenis_agenda', 1)->orderBy('updated_at', 'DESC')->first();

        $tokenList = Arr::pluck($tok,'token');  // Array data token 

        // dd($tokenList);


        
        // dd($notif->nama);
        $dat = \Carbon\Carbon::parse($notif->tanggal)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia
           
            $notification = [
                'image' => 'https://cdnaz.cekaja.com/media/2019/11/324_Artikel_CA19_Deretan-Hotel-Murah-untuk-Keluarga-di-Kota-Banyuwangi.-Mulai-dari-Rp.-75-Ribu-Saja.jpg',
                'title'=> $notif->nama,
                'body' => $notif->keterangan.'. '.$dat,
                'sound' => true,
            ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

            $fcmNotification = [
                'registration_ids' => $tokenList, //multple token array
                // 'to'        => $tok, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];
        $headers = [
            'Authorization: key=AAAABP4uS2A:APA91bEewylScLI5MFdjyQ_Tt67vwzZcsfqa-1d43F-6tKT98aRXbt7yAtnbQyqMT2E_uipViUYaHIDJ04Nbwcft55o0x69XIPj-WsE_jvclXoxrAqJWXK4hICYFy2dPAtcpXxKAfcdS',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        dd($result);


        return response()->json($result);
	}
}
