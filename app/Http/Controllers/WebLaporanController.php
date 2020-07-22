<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Agenda;
use App\Komunitas;
use App\PimpinanKomunitas;
use App\PimpinanEcoranger;
use DB;

class WebLaporanController extends Controller
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
        } else if (auth()->user()->role == 'pimpinankomunitas') {
            $pimpinan = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
        }

        $option = Agenda::select(DB::raw('YEAR(agenda.tanggal) as year'))
            ->where('tanggal', '>', $tgl)
            ->groupBy('year')->orderBy('year', 'ASC')->get();

        $daerah = Komunitas::where('level', 1)->get();
        $komunitas = [];
        $namakomunitas = [];

        // if (auth()->user()->role == 'pimpinankomunitas') {
            
        //     $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
        //     $komunitas_id = $user->komunitas_id;
            
        //     $agenda = Agenda::where('tanggal', '<',$tgl)->where('komunitas_id', $komunitas_id)->orderBy('updated_at', 'DESC')->get();
        // }
        // $data = Agenda::where('tanggal', '<', $tgl)->orderBy('tanggal','ASC')->get();

        // Filter Tahun Jika tidak dipilih
        if ($request->tahun == 0) {
            if ($request->periode == 'minggu') {
                Carbon::setWeekStartsAt(Carbon::SUNDAY);
                Carbon::setWeekEndsAt(Carbon::SATURDAY);
                $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $agenda = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->komunitas) {
                    $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $agenda = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->periode == 'bulan') {
                $period = $tgl->format('m');
                $data = Agenda::whereMonth('tanggal', $period)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;
                    if ($request->jenis_agenda) {
                        $agenda = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } else {
                        $agenda = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->komunitas) {
                    $data = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $agenda = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->periode == 'tahun') {
                $period = $tgl->format('Y');
                $data = Agenda::whereYear('tanggal', $period)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $agenda = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->komunitas) {
                    $data = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $agenda = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->periode == 'hari') {
                $data = Agenda::whereDate('tanggal', Carbon::today())->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $agenda = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->komunitas) {
                    $data = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $agenda = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                }
            } elseif ($request->komunitas) {
                $data = Agenda::where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
            } elseif ($request->jenis_agenda) {
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    if ($request->jenis_agenda) {
                        $agenda = Agenda::where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->jenis_agenda) {
                    $data = Agenda::where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } else {
                $data = Agenda::where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;

                    $agenda = Agenda::where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
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
                    $agenda = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                } else {
                    $agenda = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } elseif ($request->komunitas) {
                $data = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                if ($request->jenis_agenda) {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } elseif ($request->jenis_agenda) {
                if (auth()->user()->role == 'pimpinankomunitas') {

                    $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                    $komunitas_id = $user->komunitas_id;
                    $agenda = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->jenis_agenda) {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            } else {
                $data = Agenda::whereYear('tanggal', $tahun)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
            }
        }

        // Untuk Cetak PDF 
        if ($request->input('cetakPdf')) {
            // Filter Tahun jika tidak dipilih
            if ($request->tahun == 0) {
                if ($request->periode == 'minggu') {
                    Carbon::setWeekStartsAt(Carbon::SUNDAY);
                    Carbon::setWeekEndsAt(Carbon::SATURDAY);
                    $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $agenda = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $agenda = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->periode == 'bulan') {
                    $period = $tgl->format('m');
                    $data = Agenda::whereMonth('tanggal', $period)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;
                        if ($request->jenis_agenda) {
                            $agenda = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        } else {
                            $agenda = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereMonth('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $agenda = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereMonth('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->periode == 'tahun') {
                    $period = $tgl->format('Y');
                    $data = Agenda::whereYear('tanggal', $period)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $agenda = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereYear('tanggal', $period)->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $agenda = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereYear('tanggal', $period)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->periode == 'hari') {
                    $data = Agenda::whereDate('tanggal', Carbon::today())->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $agenda = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->komunitas) {
                        $data = Agenda::whereDate('tanggal', Carbon::today())->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        if ($request->jenis_agenda) {
                            if (auth()->user()->role == 'pimpinankomunitas') {

                                $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                                $komunitas_id = $user->komunitas_id;

                                if ($request->jenis_agenda) {
                                    $agenda = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                                }
                            } elseif ($request->jenis_agenda) {
                                $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        }
                    } elseif ($request->jenis_agenda) {
                        if (auth()->user()->role == 'pimpinankomunitas') {

                            $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                            $komunitas_id = $user->komunitas_id;

                            if ($request->jenis_agenda) {
                                $agenda = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                            }
                        } elseif ($request->jenis_agenda) {
                            $data = Agenda::whereDate('tanggal', Carbon::today())->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    }
                } elseif ($request->komunitas) {
                    $data = Agenda::where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        if ($request->jenis_agenda) {
                            $agenda = Agenda::where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                        }
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } else {
                    $data = Agenda::where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;

                        $agenda = Agenda::where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
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
                        $agenda = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } else {
                        $agenda = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->komunitas) {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('komunitas_id', $kom)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    if ($request->jenis_agenda) {
                        $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } elseif ($request->jenis_agenda) {
                    if (auth()->user()->role == 'pimpinankomunitas') {

                        $user = PimpinanKomunitas::where('user_id', auth()->user()->id)->first();
                        $komunitas_id = $user->komunitas_id;
                        $agenda = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('komunitas_id', $komunitas_id)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    } elseif ($request->jenis_agenda) {
                        $data = Agenda::whereYear('tanggal', $tahun)->where('jenis_agenda', $jenis_agenda)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                    }
                } else {
                    $data = Agenda::whereYear('tanggal', $tahun)->where('tanggal', '<', $tgl)->orderBy('tanggal', 'ASC')->get();
                }
            }
            return view ('admins.layouts_sidebar.laporan.cetakPdf', compact('pimpinan', 'data', 'komunitas', 'daerah', 'option', 'tahun', 'periode', 'kom', 'jenis_agenda', 'namakomunitas'));
        } else {
            return view ('admins.layouts_sidebar.laporan.index', compact('pimpinan', 'data', 'komunitas', 'daerah', 'option', 'tahun', 'periode', 'kom', 'jenis_agenda', 'namakomunitas'));
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
}
