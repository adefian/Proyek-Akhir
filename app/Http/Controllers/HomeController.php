<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempatSampah;
use App\Komunitas;
use App\Agenda;

class HomeController extends Controller
{
    public function index()
    {
        $tempatsampah = TempatSampah::all();
        $komunitas = Komunitas::where('level', 1)->get();
        $agenda = Agenda::all();
        return view ('home.index', compact('tempatsampah','komunitas','agenda'));
    }
}
