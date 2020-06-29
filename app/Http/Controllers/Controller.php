<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


use View;
use App\TempatSampah;
use App\Agenda;
use App\User;
use App\Point;
use App\Komunitas;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        
        setlocale(LC_TIME, 'nl_NL.utf8');
        Carbon::setLocale('id');
        
        $tgl = Carbon::now();
        $tgl1 = $tgl->subDays(1);
        $h5jam = $tgl->subHours(3);
        
        $notiftempatsampah = TempatSampah::where('status', 'penuh')->orderBy('updated_at', 'DESC')->get();
        
        $notifambilsampah = TempatSampah::where('status', 'ambil')->orderBy('updated_at', 'DESC')->get();
        
        $notifagenda = Agenda::where('created_at', '>', $tgl1)->where('tanggal', '>',$tgl)->orWhere('updated_at', '>', $tgl1)->orderBy('updated_at', 'DESC')->get();
        
        $notifagendamendesak = Agenda::where('jenis_agenda', 1)->where('tanggal', '>',$tgl)->orderBy('updated_at', 'DESC')->get();
        
        $notifsampahmasuk = Point::where('created_at', '>', $tgl1)->orderBy('updated_at', 'DESC')->get();

        $notifvalidasi = Komunitas::where('level', 0)->orderBy('updated_at', 'DESC')->get();

        //Hapus Agenda Kadaluarsa//////////////////
        // Agenda::where('tanggal','<',$h5jam)->delete();

        View::share ( 'notiftempatsampah', $notiftempatsampah );
        View::share ( 'notifambilsampah', $notifambilsampah );
        View::share ( 'tgl', $tgl );
        View::share ( 'notifagenda', $notifagenda );
        View::share ( 'notifagendamendesak', $notifagendamendesak );
        View::share ( 'notifsampahmasuk', $notifsampahmasuk );
        View::share ( 'notifvalidasi', $notifvalidasi );

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $tok = User::all(); //ambil data user
        // $tok = Token::all()->except(3,4); //ambil data user
        $notif = TempatSampah::where('status', 'penuh')->orderBy('updated_at', 'DESC')->first();
        
        $tokenList = Arr::pluck($tok,'token');  // Array data token 
        
        if($notif){

            $dat = \Carbon\Carbon::parse($notif->updated_at)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia
        }else {
            $dat ='';
        }
        
            $notification = [
                'title'=> 'Sampah Penuh',
                'body' => $dat,
                'sound' => true,
                // 'image' => 'http://192.168.43.229/relasi/public/foto_user/1589960002_.jpeg'
            ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

            $fcmNotification = [
                'registration_ids' => $tokenList, //multple token array
                // 'to'        => $tok, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];
        $headers = [
            // 'Authorization: key=AAAABP4uS2A:APA91bEewylScLI5MFdjyQ_Tt67vwzZcsfqa-1d43F-6tKT98aRXbt7yAtnbQyqMT2E_uipViUYaHIDJ04Nbwcft55o0x69XIPj-WsE_jvclXoxrAqJWXK4hICYFy2dPAtcpXxKAfcdS',
            // 'Authorization: key=AAAAuYgA5bE:APA91bFSdM8CYQpIvYOiUSqa6xv_52FeZ7oagezJUd0Nwo5EARHYmPWgVT4Uajj4Bo8orvgYP9sc8CZj6JYhCwfp9uid9-Kn_uC57SedJu3VirHBwXIyHucG_sgWKCUtiBVv0UEMxA7L',
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

        return response()->json($result);

    }
}
