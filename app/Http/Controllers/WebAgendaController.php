<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Agenda;
use App\User;
use App\PimpinanEcoranger;
use App\PimpinanKomunitas;
use App\AnggotaKomunitas;
use App\Komunitas;
use App\Token;
use Carbon\Carbon;
use DB;
use File;
use App\Notif;

class WebAgendaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        setlocale(LC_TIME, 'nl_NL.utf8');
        \Carbon\Carbon::setLocale('id');

        $tgl = Carbon::now();
        $periode = $request->periode;
        $kom = $request->komunitas;
        if ($kom) {
            $namakomunitas = Komunitas::findOrFail($kom)->where('level', 1)->first();
        }
        $jenis_agenda = $request->jenis_agenda;
        $tahun = $request->tahun;
        $pimpinan = [];
        if (auth()->user()->role == 'pimpinanecoranger') {
            $pimpinan = PimpinanEcoranger::where('user_id', auth()->user()->id)->first();
        }

        $option = Agenda::select(DB::raw('YEAR(agenda.tanggal) as year'))
            ->where('tanggal', '>', $tgl)
            ->groupBy('year')->orderBy('year', 'ASC')->get();

        $daerah = Komunitas::where('level', 1)->get();
        $komunitas = [];
        $namakomunitas = [];

        // Filter Tahun jika tidak dipilih
        if ($request->tahun == 0) {
            if ($request->periode == 'minggu') {
                Carbon::setWeekStartsAt(Carbon::SUNDAY);
                Carbon::setWeekEndsAt(Carbon::SATURDAY);
                $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->komunitas) {
                    $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->periode == 'bulan') {
                $period = $tgl->format('m');
                $data = Agenda::whereMonth('tanggal', $period)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;
                    if ($request->jenis_agenda) {
                        $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } else {
                        $komunitas  = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;
                    if ($request->jenis_agenda) {
                        $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } else {
                        $komunitas  = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->komunitas) {
                    $data = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->periode == 'tahun') {
                $period = $tgl->format('Y');
                $data = Agenda::whereYear('tanggal', $period)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->komunitas) {
                    $data = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->periode == 'hari') {
                $data = Agenda::whereDate('tanggal', Carbon::today())->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->komunitas) {
                    $data = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->komunitas) {
                $data = Agenda::where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
            } elseif ($request->jenis_agenda) {
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    if ($request->jenis_agenda) {
                        $komunitas  = Agenda::where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    if ($request->jenis_agenda) {
                        $komunitas  = Agenda::where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->jenis_agenda) {
                    $data = Agenda::where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } else {
                $data = Agenda::where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $komunitas  = Agenda::where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            }
            $tahun = 0;
        }
        // Filter Tahun dipilih
        else {
            if (auth()->user()->role == 'pimpinankomunitas') {

                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                $komunitas_id = $user->komunitas_id;

                if ($request->jenis_agenda) {
                    $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } else {
                    $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } elseif (auth()->user()->role == 'komunitas') {

                $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                $komunitas_id = $user->komunitas_id;

                if ($request->jenis_agenda) {
                    $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } else {
                    $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } elseif ($request->komunitas) {
                $data = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                if ($request->jenis_agenda) {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } elseif ($request->jenis_agenda) {
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;
                    $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;
                    $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->jenis_agenda) {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } else {
                $data = Agenda::whereYear('tanggal', $tahun)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
            }
        }

        // Untuk Cetak PDF 
        if ($request->input('cetakPdf')) {
            // Filter Tahun jika tidak dipilih
            if ($request->tahun == 0) {
                if ($request->periode == 'minggu') {
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif (auth()->user()->role == 'komunitas') {

                                $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->periode == 'bulan') {
                    $period = $tgl->format('m');
                    $data = Agenda::whereMonth('tanggal', $period)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;
                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        } else {
                            $komunitas  = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;
                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        } else {
                            $komunitas  = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif (auth()->user()->role == 'komunitas') {

                                $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->periode == 'tahun') {
                    $period = $tgl->format('Y');
                    $data = Agenda::whereYear('tanggal', $period)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif (auth()->user()->role == 'komunitas') {

                                $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->periode == 'hari') {
                    $data = Agenda::whereDate('tanggal', Carbon::today())->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif (auth()->user()->role == 'komunitas') {

                                $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif (auth()->user()->role == 'komunitas') {

                            $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $komunitas  = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->komunitas) {
                    $data = Agenda::where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $komunitas  = Agenda::where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } else {
                    $data = Agenda::where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $komunitas  = Agenda::where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
                $tahun = 0;
            }
            // Filter Tahun dipilih
            else {
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    if ($request->jenis_agenda) {
                        $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } else {
                        $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif (auth()->user()->role == 'komunitas') {

                    $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    if ($request->jenis_agenda) {
                        $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } else {
                        $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->komunitas) {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $kom)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;
                        $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif (auth()->user()->role == 'komunitas') {

                        $user = AnggotaKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;
                        $komunitas  = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } else {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('tanggal', '>', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            }
            return view('admins.layouts_sidebar.monitoring_komunitas.cetakPdf', compact('pimpinan', 'data', 'komunitas', 'daerah', 'option', 'tahun', 'periode', 'kom', 'jenis_agenda', 'namakomunitas'));
        } else {
            return view('admins.layouts_sidebar.monitoring_komunitas.kelola_agenda', compact('pimpinan', 'data', 'komunitas', 'daerah', 'option', 'tahun', 'periode', 'kom', 'jenis_agenda', 'namakomunitas'));
        }
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
        if ($request->jenis_agenda == null) {
            alert()->error('Pilihan Jenis Agenda tidak boleh kosong', 'Gagal')->persistent('Close');
            return back();
        } elseif ($request->komunitas_id == null) {
            alert()->error('Pilihan Komunitas tidak boleh kosong', 'Gagal')->persistent('Close');
            return back(); 
        } else {

            $user = auth()->user()->id;

            if (auth()->user()->role == 'pimpinankomunitas') {
                $anggota = PimpinanKomunitas::where('user_id', $user)->first();
                $komunitas_id = $anggota->komunitas_id;
            }

            $tanggal_rutin = ([
                $e = Carbon::parse($request->tanggal),
                $e = Carbon::parse($request->tanggal)->addDays(7),
                $e = Carbon::parse($request->tanggal)->addDays(14),
                $e = Carbon::parse($request->tanggal)->addDays(21),
            ]);


            if ($request->jenis_agenda == "3") {
                foreach ($tanggal_rutin as $item => $v) {
                    $input = ([
                        'nama' => $request->nama,
                        'keterangan' => $request->keterangan,
                        'jenis_agenda' => $request->jenis_agenda,
                        'tanggal' => $v,
                        'user_id' => $user,

                    ]);
                    if ($file = $request->file('file_gambar')) {
                        $nama = time() . ".jpeg";
                        $file->move('agenda/', $nama);
                        $input['file_gambar'] = $nama;
                    }

                    if (auth()->user()->role == 'komunitas') {
                        $input['komunitas_id'] = $komunitas_id;
                    }

                    if (auth()->user()->role == 'pimpinanecoranger') {
                        $input['komunitas_id'] = $request->komunitas_id;
                    }

                    Agenda::create($input);
                }
            } else {

                $input = ([
                    'nama' => $request->nama,
                    'keterangan' => $request->keterangan,
                    'jenis_agenda' => $request->jenis_agenda,
                    'tanggal' => $request->tanggal,
                    'user_id' => $user,
                ]);

                if ($file = $request->file('file_gambar')) {
                    $nama = time() . ".jpeg";
                    $file->move('agenda/', $nama);
                    $input['file_gambar'] = $nama;
                }

                if (auth()->user()->role == 'pimpinankomunitas') {
                    $input['komunitas_id'] = $komunitas_id;
                }

                if (auth()->user()->role == 'pimpinanecoranger') {
                    $input['komunitas_id'] = $request->komunitas_id;
                }
                Agenda::create($input);
            }

            $notif = new Notif;
            $notif->NotifTambahAgenda();

            alert()->success('Data berhasil ditambahkan');
            return back();
        }
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
            $agenda = Agenda::findOrFail($id);

            $user =  auth()->user()->id;

            $input = ([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'user_id' => $user,
                'tanggal' => $request->tanggal
            ]);

            if ($request->jenis_agenda === '1' || $request->jenis_agenda === '2') {
                $input['jenis_agenda'] = $request->jenis_agenda;
            } elseif ($request->jenis_agenda == null) {

            }

            if ($file = $request->file('file_gambar')) {
                $nama = time() . ".jpeg";
                $file->move('agenda/', $nama);
                $input['file_gambar'] = $nama;
            }

            $agenda->update($input);

            $notif = new Notif();
            $notif->NotifEditAgenda();

            alert()->success('Berhasil', 'Data Berhasil diedit');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Agenda::find($id);
        File::delete('agenda/'.$agenda->file_gambar);
        $agenda->delete($id);
        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }
}
