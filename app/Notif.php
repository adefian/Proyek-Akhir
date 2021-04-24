<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Notif extends Model
{

    public function SampahPenuh()
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        //$tok = [];
        $tok = User::where('role', 'petugaslapangan')->get(); //ambil data user
        // $tok = Token::all()->except(3,4); //ambil data user
        $notif = TempatSampah::where('status', 'penuh')->orderBy('updated_at', 'DESC')->first();
        $tokenList = Arr::pluck($tok, 'token');  // Array data token 
        if ($notif) {
            $dat = \Carbon\Carbon::parse($notif->updated_at)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia
            
            $notification = [
                'title' => 'Sampah Penuh',
                'body' => $dat,
                'sound' => true,
            ];

            $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

            $fcmNotification = [
                'registration_ids' => $tokenList, //multple token array
                // 'to'        => $tok, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];
            $headers = [
                // 'Authorization: key=AAAABP4uS2A:APA91bEewylScLI5MFdjyQ_Tt67vwzZcsfqa-1d43F-6tKT98aRXbt7yAtnbQyqMT2E_uipViUYaHIDJ04Nbwcft55o0x69XIPj-WsE_jvclXoxrAqJWXK4hICYFy2dPAtcpXxKAfcdS',
                'Content-Type: application/json',
                'Authorization: key=AAAAuYgA5bE:APA91bFSdM8CYQpIvYOiUSqa6xv_52FeZ7oagezJUd0Nwo5EARHYmPWgVT4Uajj4Bo8orvgYP9sc8CZj6JYhCwfp9uid9-Kn_uC57SedJu3VirHBwXIyHucG_sgWKCUtiBVv0UEMxA7L'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            $result = curl_exec($ch);
            curl_close($ch);
            
            return $result;
        }
    }

    public function NotifTambahAgenda()
    {

        $tok = User::all(); //ambil data user
        $notif = Agenda::orderBy('created_at', 'DESC')->first();
        $tokenList = Arr::pluck($tok, 'token');  // Array data token 
        $dat = \Carbon\Carbon::parse($notif->tanggal)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia
        $notification = [
            'title' => $notif->nama,
            'body' => $notif->keterangan . '.   ' . $dat,
            'sound' => true,
            'image' => 'https://ta.poliwangi.ac.id/~ti17136/agenda/'.$notif->file_gambar.   ''
        ];

        $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

        $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
            // 'to'        => $tok, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        $headers = [
            'Content-Type: application/json',
            'Authorization: key=AAAAuYgA5bE:APA91bFSdM8CYQpIvYOiUSqa6xv_52FeZ7oagezJUd0Nwo5EARHYmPWgVT4Uajj4Bo8orvgYP9sc8CZj6JYhCwfp9uid9-Kn_uC57SedJu3VirHBwXIyHucG_sgWKCUtiBVv0UEMxA7L',
            'Connection: keep-alive'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function NotifEditAgenda()
    {   
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $tok = User::all(); //ambil data user
        $notif = Agenda::orderBy('updated_at', 'DESC')->first();
        $tokenList = Arr::pluck($tok, 'token');  // Array data token 
        $dat = \Carbon\Carbon::parse($notif->tanggal)->isoFormat('LLLL'); //buat tanggal sesuai format Indonesia

        $notification = [
            'title' => $notif->nama,
            'body' => $notif->keterangan . '. ' . $dat,
            'sound' => true,
            'image' => 'https://ta.poliwangi.ac.id/~ti17136/agenda/'.$notif->file_gambar.   ''
        ];

        $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

        $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
            // 'to'        => $tok, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        $headers = [
            // 'Authorization: key=AAAABP4uS2A:APA91bEewylScLI5MFdjyQ_Tt67vwzZcsfqa-1d43F-6tKT98aRXbt7yAtnbQyqMT2E_uipViUYaHIDJ04Nbwcft55o0x69XIPj-WsE_jvclXoxrAqJWXK4hICYFy2dPAtcpXxKAfcdS',
            'Authorization: key=AAAAuYgA5bE:APA91bFSdM8CYQpIvYOiUSqa6xv_52FeZ7oagezJUd0Nwo5EARHYmPWgVT4Uajj4Bo8orvgYP9sc8CZj6JYhCwfp9uid9-Kn_uC57SedJu3VirHBwXIyHucG_sgWKCUtiBVv0UEMxA7L',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
