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
use App\Notif;

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

        $notifagenda = Agenda::where('created_at', '>', $tgl1)->where('tanggal', '>', $tgl)->orWhere('updated_at', '>', $tgl1)->orderBy('updated_at', 'DESC')->get();

        $notifagendamendesak = Agenda::where('jenis_agenda', 1)->where('tanggal', '>', $tgl)->orderBy('updated_at', 'DESC')->get();

        $notifsampahmasuk = Point::where('created_at', '>', $tgl1)->orderBy('updated_at', 'DESC')->get();

        $notifvalidasi = Komunitas::where('level', 0)->orderBy('updated_at', 'DESC')->get();

        //Hapus Agenda Kadaluarsa//////////////////
        // Agenda::where('tanggal','<',$h5jam)->delete();

        View::share('notiftempatsampah', $notiftempatsampah);
        View::share('notifambilsampah', $notifambilsampah);
        View::share('tgl', $tgl);
        View::share('notifagenda', $notifagenda);
        View::share('notifagendamendesak', $notifagendamendesak);
        View::share('notifsampahmasuk', $notifsampahmasuk);
        View::share('notifvalidasi', $notifvalidasi);

        $notif = new Notif();
        $notif->SampahPenuh();
        
    }
}
