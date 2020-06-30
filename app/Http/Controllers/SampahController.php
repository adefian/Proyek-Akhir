<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaksi;
use App\Point;
use App\Masyarakat;
use Carbon\Carbon;


class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Point::orderBy('updated_at','DESC')->get();
        
        return view ('admins.layouts_sidebar.daftar_pembuang_sampah.index', compact('data','data2'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tukarcode()
    {
        $masyarakat = Masyarakat::find(1);
        return view('tukarcode', compact('masyarakat'));
    }

    public function pushtukarcode(Request $request)
    {
        $poin = Point::where('kode_reward', $request->kode_reward)->first();

        $data = ([
            'masyarakat_id' => 1,
            'kode_reward' => null ,
        ]);
        
        $poin->update($data);

        $poin_baru = $poin->nilai;
        $masyarakat = Masyarakat::findOrFail(1);
        $poin_lama = $masyarakat->total_poin;
        $total_poin = $poin_baru + $poin_lama;

        // dd($total_poin);

        $masyarakat->update(['total_poin' => $total_poin]);
        alert()->success('Sukses');
        return back();
    }

    public function poin(Request $request)
    {
        $tgl = Carbon::now();
        $periode = $request->periode;
        $list = $request->list;

            if ($request->list == '10')  {
                if ($request->periode == 'hari')  {
                    $data = Masyarakat::whereDate('updated_at', Carbon::today())->orderBy('total_poin', 'desc')->paginate(10);
                } elseif ($request->periode == 'minggu') {
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $data = Masyarakat::whereBetween('updated_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('total_poin', 'desc')->paginate(10);
                } elseif ($request->periode == 'bulan') {
                    $period = $tgl->format('m'); 
                    $data = Masyarakat::whereMonth('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(10);
                } elseif ($request->periode == 'tahun') {
                    $period = $tgl->format('Y'); 
                    $data = Masyarakat::whereYear('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(10);
                } else {
                    $data = Masyarakat::orderBy('total_poin', 'desc')->paginate(10);
                }

            } elseif ($request->list == '20') {
                if ($request->periode == 'hari')  {
                    $data = Masyarakat::whereDate('updated_at', Carbon::today())->orderBy('total_poin', 'desc')->paginate(20);
                } elseif ($request->periode == 'minggu') {
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $data = Masyarakat::whereBetween('updated_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('total_poin', 'desc')->paginate(20);
                } elseif ($request->periode == 'bulan') {
                    $period = $tgl->format('m'); 
                    $data = Masyarakat::whereMonth('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(20);
                } elseif ($request->periode == 'tahun') {
                    $period = $tgl->format('Y'); 
                    $data = Masyarakat::whereYear('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(20);
                } else {
                    $data = Masyarakat::orderBy('total_poin', 'desc')->paginate(20);
                }

            } elseif ($request->periode == 'hari')  {
                $data = Masyarakat::whereDate('updated_at', Carbon::today())->orderBy('total_poin', 'desc')->input();
            } elseif ($request->periode == 'minggu') {
                Carbon::setWeekStartsAt(Carbon::SUNDAY);
                Carbon::setWeekEndsAt(Carbon::SATURDAY);
                $data = Masyarakat::whereBetween('updated_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('total_poin', 'desc')->get();
            } elseif ($request->periode == 'bulan') {
                $period = $tgl->format('m'); 
                $data = Masyarakat::whereMonth('updated_at',$period)->orderBy('total_poin', 'desc')->get();
            } elseif ($request->periode == 'tahun') {
                $period = $tgl->format('Y'); 
                $data = Masyarakat::whereYear('updated_at',$period)->orderBy('total_poin', 'desc')->get();
            } else {
                $data = Masyarakat::orderBy('total_poin', 'desc')->get();
            }
                    
        if($request->input('cetakPdf')){
            $tgl = Carbon::now();

            if ($request->list == '10')  {
                if ($request->periode == 'hari')  {
                    $data = Masyarakat::whereDate('updated_at', Carbon::today())->orderBy('total_poin', 'desc')->paginate(10);
                } elseif ($request->periode == 'minggu') {
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $data = Masyarakat::whereBetween('updated_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('total_poin', 'desc')->paginate(10);
                } elseif ($request->periode == 'bulan') {
                    $period = $tgl->format('m'); 
                    $data = Masyarakat::whereMonth('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(10);
                } elseif ($request->periode == 'tahun') {
                    $period = $tgl->format('Y'); 
                    $data = Masyarakat::whereYear('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(10);
                } else {
                    $data = Masyarakat::orderBy('total_poin', 'desc')->paginate(10);
                }

            } elseif ($request->list == '20') {
                if ($request->periode == 'hari')  {
                    $data = Masyarakat::whereDate('updated_at', Carbon::today())->orderBy('total_poin', 'desc')->paginate(20);
                } elseif ($request->periode == 'minggu') {
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $data = Masyarakat::whereBetween('updated_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('total_poin', 'desc')->paginate(20);
                } elseif ($request->periode == 'bulan') {
                    $period = $tgl->format('m'); 
                    $data = Masyarakat::whereMonth('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(20);
                } elseif ($request->periode == 'tahun') {
                    $period = $tgl->format('Y'); 
                    $data = Masyarakat::whereYear('updated_at',$period)->orderBy('total_poin', 'desc')->paginate(20);
                } else {
                    $data = Masyarakat::orderBy('total_poin', 'desc')->paginate(20);
                }

            } elseif ($request->periode == 'hari')  {
                $data = Masyarakat::whereDate('updated_at', Carbon::today())->orderBy('total_poin', 'desc')->get();
            } elseif ($request->periode == 'minggu') {
                Carbon::setWeekStartsAt(Carbon::SUNDAY);
                Carbon::setWeekEndsAt(Carbon::SATURDAY);
                $data = Masyarakat::whereBetween('updated_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('total_poin', 'desc')->get();
            } elseif ($request->periode == 'bulan') {
                $period = $tgl->format('m'); 
                $data = Masyarakat::whereMonth('updated_at',$period)->orderBy('total_poin', 'desc')->get();
            } elseif ($request->periode == 'tahun') {
                $period = $tgl->format('Y'); 
                $data = Masyarakat::whereYear('updated_at',$period)->orderBy('total_poin', 'desc')->get();
            } else {
                $data = Masyarakat::orderBy('total_poin', 'desc')->get();
            }
            
            return view ('admins.layouts_sidebar.daftar_pembuang_sampah.cetakPdf', compact('data','list','periode'));
        }

        else {
            return view ('admins.layouts_sidebar.daftar_pembuang_sampah.poin', compact('data','list','periode'));

        }
    }
}
