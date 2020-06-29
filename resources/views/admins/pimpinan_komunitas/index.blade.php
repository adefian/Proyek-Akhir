@extends('layouts_admin.admin')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('navbar')
    @include('admins.pimpinan_komunitas.navbar')
@endsection

@section('sidebar')
    @include('admins.pimpinan_komunitas.sidebar')
@endsection

@section('content')

    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>

            <div class="row">
                <div class="col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                      <i class="fas fa-user-tag"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-body" style="padding:31px">
                        <h5>Pimpinan dari Komunitas {{$namakomunitas->daerahygdipilih->daerah}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-primary">
                    <div class="card-icon bg-primary">
                      <i class="fas fa-dumpster"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Tempat Sampah</h4>
                      </div>
                      <div class="card-body">
                        {{$tempatsampah}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-danger">
                    <div class="card-icon bg-danger">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Komunitas</h4>
                      </div>
                      <div class="card-body">
                        {{$komunitas}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-warning">
                    <div class="card-icon bg-warning">
                      <i class="fas fa-id-badge"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Anggota Komunitas</h4>
                      </div>
                      <div class="card-body">
                        {{$anggotakomunitas}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1 card-success">
                    <div class="card-icon bg-success">
                      <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>User</h4>
                      </div>
                      <div class="card-body">
                        {{$user}}
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <!-- <div class="row justify-content-center">
              <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                      <h4>Data Agenda</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-7 col-12">
                          <canvas id="myChart3"></canvas>
                        </div>
                          <div class="col-lg-5 col-12">
                            <div class="form-group">
                              <label class="control-label">Date</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                  </div>
                                </div>
                                <input type="text" class="form-control" name="daterange" id="daterange">
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
             -->
          <div class="section-body">
          </div>
        </section>
    </div>

@endsection

@section('js')

<script src="{{asset('js/Chart.min.js')}}"></script>
<!-- <script src="{{asset('assets/stisla/js/page/modules-chartjs.js')}}"></script> -->
    <script>
      "use strict";

      // var ctx = document.getElementById("myChart3").getContext('2d');
      // var myChart = new Chart(ctx, {
      //   type: 'doughnut',
      //   data: {
      //     datasets: [{
      //       data: {!! json_encode($nilai) !!},
      //       backgroundColor: [
      //         '#47c363',
      //         '#fc544b'
      //       ],
      //       label: 'Dataset 1'
      //     }],
      //     labels: [
      //       'Benar',
      //       'Salah'
      //     ],
      //   },
      //   options: {
      //     responsive: true,
      //     legend: {
      //       position: 'bottom',
      //     },
      //   }
      // });
    
    //
      // var ctx = document.getElementById("myChart3").getContext('2d');
      // var myChart = new Chart(ctx, {
      //   type: 'bar',
      //   data: {
      //     datasets: [{
      //       label: 'Jumlah',
      //       data: {!! json_encode($nilai) !!},
      //       borderWidth: 2,
      //       backgroundColor: ['#47c363','#fc544b'],
      //       borderColor: ['#47c363','#fc544b'],
      //       borderWidth: 2,
      //       pointBackgroundColor: '#ffffff',
      //       pointRadius: 4,
      //     }],
      //     labels: ["Benar", "Salah"],
      //   },

      //   options: {
      //     legend: {
      //       display: false
      //     },
      //     scales: {
      //       yAxes: [{
      //         gridLines: {
      //           drawBorder: false,
      //           color: '#f2f2f2',
      //         },
      //         ticks: {
      //           beginAtZero: true,
      //           stepSize: 50
      //         }
      //       }],
      //       xAxes: [{
      //         ticks: {
      //           display: true
      //         },
      //         gridLines: {
      //           display: true
      //         },
      //       }]
      //     },
      //   }
      // });
    //
  //
      // var ctx = document.getElementById("myChart3").getContext('2d');
      // var myChart = new Chart(ctx, {
      //   type: 'bar',
      //   data: {
      //     datasets: [{
      //       label: 'Salah',
      //       data: [46, 48, 30, 52],
      //       borderWidth: 2,
      //       backgroundColor: '#fc544b',
      //       borderColor: '#fc544b',
      //       borderWidth: 2,
      //       pointBackgroundColor: '#ffffff',
      //       pointRadius: 4,
      //     }, {
      //       label: 'Benar',
      //       data: [4, 8, 2, 22],
      //       borderWidth: 2,
      //       backgroundColor: '#47c363',
      //       borderColor: '#47c363',
      //       borderWidth: 2,
      //       pointBackgroundColor: '#ffffff',
      //       pointRadius: 4,
      //     }],
      //     labels: {!! json_encode($tempat) !!},
      //   },

      //   options: {
      //     legend: {
      //       responsive: true,
      //       rounded: true,
      //       position: 'bottom',
      //     },
      //     scales: {
      //       yAxes: [{
      //         gridLines: {
      //           drawBorder: false,
      //           color: '#f2f2f2',
      //         },
      //         ticks: {
      //           beginAtZero: true,
      //           stepSize: 15
      //         }
      //       }],
      //       xAxes: [{
      //         ticks: {
      //           display: true
      //         },
      //         gridLines: {
      //           display: false
      //         },
      //       }]
      //     },
      //   }
      // });
  //
    </script>

    <script type="text/javascript">
            $(function() {
        $('input[id="daterange"]').daterangepicker({
          opens: 'left'
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
        });
      });
    </script>
@endsection
