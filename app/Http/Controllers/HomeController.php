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
        $agenda = Agenda::orderBy('tanggal', 'ASC')->get();
        return view ('home.index', compact('tempatsampah','komunitas','agenda'));
    }

    public function feedback(Request $request)
    {
        $input = ([
            'nama' => $request->nama,
        ]);

        Feedback::create($input);
        return back();
    }
}
