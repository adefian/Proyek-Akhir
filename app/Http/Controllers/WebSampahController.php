<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaksi;
use App\Point;
use App\Masyarakat;
use App\PimpinanEcoranger;
use Carbon\Carbon;


class WebSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Point::where('status', 0)->orWhere('status', 1)->orderBy('updated_at','DESC')->get();
        
        return view ('admins.layouts_sidebar.daftar_pembuang_sampah.index', compact('data'));
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

        $pimpinan = [];
        if(auth()->user()->role == 'pimpinanecoranger'){
            $pimpinan = PimpinanEcoranger::where('user_id', auth()->user()->id)->first();
        }

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
                    
        # Cetak PDF
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
            
            return view ('admins.layouts_sidebar.daftar_pembuang_sampah.cetakPdf', compact('pimpinan','data','list','periode'));
        }

        else {
            return view ('admins.layouts_sidebar.daftar_pembuang_sampah.poin', compact('pimpinan','data','list','periode'));

        }
    }

    public function datasensor(Request $request)
    {
        //1 13 07 06 20 100 tff XAB
      	//0 12 34 56 78 901 234 567

      	//sap = sampah anorganik penuh
      	//sop = sampah organik penuh
      	//slp = sampah logam penuh

      	//bap = anorganik benar  10
      	//bop = organik benar    5
		//blp = logam benar		 15

        $id_ts = Str::substr($request->code_reward , 0,1);
        $kode_reward = Str::substr($request->code_reward, 15,3);

        $sap = Str::substr($request->code_reward , 9,1);
        $sop = Str::substr($request->code_reward , 10,1);
        $slp = Str::substr($request->code_reward , 11,1);

        $bap = Str::substr($request->code_reward , 12,1);
        $bop = Str::substr($request->code_reward , 13,1);
        $blp = Str::substr($request->code_reward , 14,1);

        $data =  ([
            'code_reward' => $request->code_reward,
            'tempat_sampah_id' => $id_ts,
            'kode_reward' => $kode_reward,
        ]);

        if($sap == 1 || $sop == 1 || $slp == 1){
            $penuh = (['status' => "penuh"]);
            $ts = TempatSampah::findOrFail($id_ts);
            
            $ts->update($penuh);
        } else if($sap == 0 && $sop == 0 && $slp == 0){
            $penuh = (['status' => "kosong"]);
            $ts = TempatSampah::findOrFail($id_ts);
            
            $ts->update($penuh);
        }

        if($bap == "t"){
            $data['status'] = "1";
            $data['nilai'] = 10;
        } else if($bop == "t"){
            $data['status'] = "1";
            $data['nilai'] = 5;
        } else if($blp == "t"){
            $data['status'] = "1";
            $data['nilai'] = 15;
        }

		
        Point::create($data);
		//DB::table('point')->insert($data);	
        return response()->json($data);

    }

    public function ambildata_mqtt(Request $request, Point $cm)
    {    
        $bodyContent = $request->getContent();        

        //$cm->api($request,$cm); 
        //return gettype($bodyContent);

        $id_ts = Str::substr($bodyContent , 0,1);
        $kode_reward = Str::substr($bodyContent , 15,3);
    
        $sap = Str::substr($bodyContent , 9,1);
        $sop = Str::substr($bodyContent , 10,1);
        $slp = Str::substr($bodyContent , 11,1);
    
        $bap = Str::substr($bodyContent , 12,1);
        $bop = Str::substr($bodyContent , 13,1);
        $blp = Str::substr($bodyContent , 14,1);
    
        $data =  ([
            'datasensor' => $bodyContent,
            'tempat_sampah_id' => $id_ts,
            'kode_reward' => $kode_reward,
        ]);
    
        if($sap == 1 || $sop == 1 || $slp == 1){
        $penuh = (['status' => "penuh"]);
        $ts = TempatSampah::findOrFail($id_ts);
        
        $ts->update($penuh);
        } else if($sap == 0 && $sop == 0 && $slp == 0){
        $penuh = (['status' => "kosong"]);
        $ts = TempatSampah::findOrFail($id_ts);
        
        $ts->update($penuh);
        }
    
        if($bap == "t"){
        $data['status'] = "1";
        $data['nilai'] = 10;
        } else if($bop == "t"){
        $data['status'] = "1";
        $data['nilai'] = 5;
        } else if($blp == "t"){
        $data['status'] = "1";
        $data['nilai'] = 15;
        }
    
        
        Point::create($data);
        //DB::table('point')->insert($data);	
        return response()->json([$data, $penuh]);

    }

    public function data(){
        $data = Point::all();

        return view('datasensor', compact('data'));
    }
}
