<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use View;
use App\TempatSampah;
use App\Agenda;
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
        
        $notiftempatsampah = TempatSampah::where('status', 1)->orderBy('updated_at', 'DESC')->get();
        
        $notifagenda = Agenda::where('created_at', '>', $tgl1)->get();

        $user = Agenda::find(1);
        
        $notifagendamendesak = Agenda::where('jenis_agenda', 1)->get();

        View::share ( 'notiftempatsampah', $notiftempatsampah );
        View::share ( 'notifagenda', $notifagenda );
        View::share ( 'notifagendamendesak', $notifagendamendesak );
    }
}
