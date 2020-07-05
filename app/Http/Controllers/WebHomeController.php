<?php

namespace App\Http\Controllers;
use LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\TempatSampah;
use App\Komunitas;
use App\Feedback;
use App\Agenda;
use Carbon\Carbon;

class WebHomeController extends Controller
{
    public function index()
    {
        $tgl = Carbon::now();
        $tempatsampah = TempatSampah::all();
        $komunitas = Komunitas::where('level', 1)->get();
        $agenda = Agenda::where('tanggal', '>',$tgl)->orderBy('tanggal', 'ASC')->get();

        
        $list = Agenda::where('tanggal', '>',$tgl)->get();
        
        $listagenda = array();
        foreach($list as $data=>$v){

            $listagenda[]= array(
                'title' => $v->nama,
                'start' => $v->tanggal,
            );
        }

        return view ('home.index', compact('tempatsampah','komunitas','agenda','listagenda'));
    }

    public function feedback(Request $request)
    {
        $input = ([
            'nama' => $request->nama,
            'email' => $request->email,
            'usulan' => $request->usulan,
        ]);

        if ($file = $request->file('gambar')) {
            $nama = time() .'_'. $file->getClientOriginalName();
            $file->move('assets/img/feedback/', $nama);  
            $input['gambar'] = $nama;
        }

        Feedback::create($input);
        alert()->success('Berhasil','Terima kasih sudah mem');
        return back();
    }

    public function feedbacks()
    {
        $data = Feedback::all();

        return view ('admins.layouts_sidebar.feedback.index', compact('data'));
    }

    public function hapusfeedback($id)
    {
        $id = Feedback::findOrFail($id);

        $id->delete($id);

        alert()->success('Sukses','Data berhasil dihapus');
        return back();
    }

    public function webview()
    {
        return view('webview');
    }
}
