<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Agenda;
use App\User;
use App\AnggotaKomunitas;
use App\Komunitas;
use App\Token;
use Carbon\Carbon;

class AgendaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        \Carbon\Carbon::setLocale('id');

        $data = Agenda::all();

        if (auth()->user()->role == 'komunitas') {
            
            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
            $komunitas_id = $user->komunitas_id;
            
            $komunitas  = Agenda::where('komunitas_id', $komunitas_id)->get();
        }

        $daerah = Komunitas::all();

        return view('admins.layouts_sidebar.monitoring_komunitas.kelola_agenda', compact('data','komunitas','daerah'));
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
        
        if (auth()->user()->role == 'komunitas') {
            $anggota = AnggotaKomunitas::where('user_id', $user)->first();
            $komunitas_id = $anggota->komunitas_id;
        }

        $input = ([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'jenis_agenda' => $request->jenis_agenda,
            'tanggal' => $request->tanggal,
            'user_id' => $user,
            'komunitas_id' => $request->komunitas_id,

        ]);

        Agenda::create($input);
        
        	
    	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $tok = User::all(); //ambil data user
        // $tok = Token::all()->except(3,4); //ambil data user

        $notif = Agenda::where('jenis_agenda', 1)->orderBy('updated_at', 'DESC')->first();

        $tokenList = Arr::pluck($tok,'token');  // Array data token 
        
        // dd($notif->nama);
        $dat = \Carbon\Carbon::parse($notif->tanggal)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia
           
            $notification = [
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


        alert()->success('Data berhasil ditambahkan','Selamat');
        return back();
        return response()->json($result);
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
            'user_id' => $user,
            'tanggal' => $request->tanggal
        ]);

        $a = $request->jenis_agenda;
        
        if ($request->jenis_agenda === '1' || $request->jenis_agenda === '0') {
            $input['jenis_agenda'] = $a;
        }
        
        $agenda->update($input);

        	
    	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        // $tok = User::all(); //ambil data user
        $tok = Token::all()->except(3,4); //ambil data user

        $notif = Agenda::where('jenis_agenda', 1)->orderBy('updated_at', 'DESC')->first();

        $tokenList = Arr::pluck($tok,'token');  // Array data token 
        
        // dd($notif->nama);
        $dat = \Carbon\Carbon::parse($notif->tanggal)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia
           
            $notification = [
                'title'=> $notif->nama,
                'body' => 'Agenda Mendesak, '.$notif->keterangan.'. '.$dat,
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


        
        alert()->success('Berhasil','Data Berhasil diedit');
        return back();
        return response()->json($result);
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
