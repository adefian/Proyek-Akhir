<?php

namespace App\Http\Controllers;

use LaravelFullcalendar\Facades\Calendar;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\PimpinanEcoranger;
use App\PimpinanKomunitas;
use App\AnggotaKomunitas;
use App\Komunitas;
use App\PetugasLapangan;
use App\PetugasKontenReward;
use App\TempatSampah;
use App\Feedback;
use App\Agenda;
use Carbon\Carbon;
use File;

class WebHomeController extends Controller
{
    public function index()
    {
        $tgl = Carbon::now();
        $tempatsampah = TempatSampah::all();
        $komunitas = Komunitas::where('level', 1)->get();
        $agenda = Agenda::where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->paginate(5);
        $pimpinan = PimpinanEcoranger::all();
        $pimpinankom = PimpinanKomunitas::all();
        $anggota_komunitas = AnggotaKomunitas::all();
        $petugaslap = PetugasLapangan::all();
        $petugaskonten = PetugasKontenReward::all();


        $list = Agenda::where('tanggal', '>', $tgl)->get();

        $listagenda = [];
        foreach ($list as $data => $v) {
            if ($v->jenis_agenda == 1) {
                $warna = 'red';
            } else if($v->jenis_agenda == 2){
                $warna = '#ffc107';
            } else{
                $warna = [];
            }

            $listagenda[] = array(
                'title' => $v->nama,
                'start' => $v->tanggal,
                'display' => 'background',
                'classNames' => [$v->keterangan, $v->komunitas->daerah],
                'color' => $warna,
            );
        }

        return view('home.index', compact('tempatsampah', 'komunitas', 'agenda', 'listagenda', 'pimpinan', 'pimpinankom', 'anggota_komunitas', 'petugaslap', 'petugaskonten'));
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
        alert()->success('Terima kasih sudah memberikan Masukan.')->persistent('Close');
        return back();
    }

    public function feedbacks()
    {
        $data = Feedback::all();

        return view('admins.layouts_sidebar.feedback.index', compact('data'));
    }

    public function hapusfeedback($id)
    {
        $id = Feedback::findOrFail($id);
        File::delete('feedback/'.$id->file_gambar);
        $id->delete($id);

        alert()->success('Sukses', 'Data berhasil dihapus');
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
