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
        $agenda = Agenda::where('tanggal', '>',$tgl)->orderBy('tanggal', 'ASC')->paginate(5);

        
        $list = Agenda::where('tanggal', '>',$tgl)->get();
        
        $listagenda = [];
        foreach($list as $data=>$v){

            $listagenda[]= array(
                'title' => $v->nama,
                'start' => $v->tanggal,
                'display' => 'background',
                'classNames' => [$v->keterangan, $v->komunitas->daerah]
            );
        }

        return view ('home.index', compact('tempatsampah','komunitas','agenda','listagenda'));
    }

    public function feedback(Request $request)
    {
        $input = ([
            'nama' => $request->nama,
            'email' => $request->email,
            'kritik_saran' => $request->kritik_saran,
        ]);

        if ($file = $request->file('file_gambar')) {
            $nama = time() . ".jpeg";
            $file->move('feedback/', $nama);  
            $input['file_gambar'] = $nama;
        }

        Feedback::create($input);
        alert()->success('Berhasil','Terima kasih sudah memberikan Masukan.');
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

    public function crop()
    {
        return view('imageUpload');
    }
}
